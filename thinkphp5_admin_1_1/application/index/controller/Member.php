<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;
use think\Hook;

use app\api\controller\Upload;	

class Member extends HomeBase
{
    public function index($keyword = '', $page = 1){

		$where = [];

		if ($keyword) {
            $where['name|phone|email'] = ['like', "%{$keyword}%"];
        }
		
		$company_id = Session::get('admin_id');
		$where['company_id'] = $company_id;
		
		$num = get_hash_table($company_id);
		$list = Db::name('company_member_'.$num)->where($where)->order('create_time','desc')->paginate(10);
		// $list = Db::name('test')->paginate(10);
		// dump($user_list);
		$page = $list->render();
		$this->assign('list', $list);
		$this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * 添加用户
     * @return mixed
     */
    public function add()
    {

		return $this->fetch();
    }
	

	/**
     * 保存用户
     */
    public function save()
    {
		try{
			if ($this->request->isPost()) {
				$data            = $this->request->post();
				$validate_result = $this->validate($data, 'User');

				if ($validate_result !== true) {
					$this->error($validate_result);
				} else {
					// $data['password'] = md5($data['password'] . Config::get('salt'));
					$company_id = Session::get('admin_id');
					$num = get_hash_table($company_id);
					$data['company_id'] = $company_id;
					$data['create_time'] = date("Y-m-d H:i:s");
		
					if(Db::name('company_member_'.$num)->insert($data)){
						
						//添加成功则记录日志
						$content = '添加公司成员：'.$data['name'];
						Hook::listen('record_log',$content);						
						
						$this->success('保存成功','/index/member/index');					
					}else{
						$this->error('保存失败');					
					}
					// $userId = Db::name('user')->getLastInsID();			
					// return json_encode(['data' => $userId,'msg' => '成功','status' =>1]);
				}
				
			}
		}catch(Exception $e){
			die($e->getMessage());
			die($e->getCode());
		}
    }

	
    /**
     * 编辑用户
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
		$company_id = Session::get('admin_id');
		$num = get_hash_table($company_id);

        $user = Db::name('company_member_'.$num)->find($id);

        return $this->fetch('edit', ['user' => $user]);
    }

    /**
     * 更新用户
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {

				$company_id = Session::get('admin_id');
				$num = get_hash_table($company_id);
				// $user = Db::name('company_member_'.$num)->find($id);
				// Db::table('think_user')->where('id', 1)->update(['name' => 'thinkphp']);
				// Db::table('think_user')->update($data);


                if (Db::name('company_member_'.$num)->update($data) !== false) {
                    $this->success('更新成功','/index/member/index');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }


    /**
     * 导出用户
     *
     */
    public function export(){

        $company_id = Session::get('admin_id');
        $where['company_id'] = $company_id;

        $num = get_hash_table($company_id);
        $list = Db::name('company_member_'.$num)->where($where)->select();

        $filename = 'test.xls';
        $titlename = 'test';
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1><head>".$titlename."</head>";
        $str .='<tr><td>用户名</td><td>手机</td><td>邮箱</td></tr>';
        foreach($list as $key => $val){
            $str .="<tr><td>{$val['name']}</td><td>{$val['phone']}</td><td>{$val['email']}</td></tr>";
        }
        $str .= "</table></body></html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }
	
	
    /**
     * 导入用户
     *
     */
    public function import(){
		return $this->fetch();
    }	
	
	
	/**
	* 执行上传
	*/
	public function doImport(){
		
		//excel配置文件
        $config = [
            'size' => 2097152,
            'ext'  => 'xlsx,xls'
        ];
		//excel上传路径
		$upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads/excel');
	
		//excel保存路径
		$save_path = '/uploads/excel/';
		
		$full_path = str_replace('\\', '/', ROOT_PATH . 'public');
		
		$upload_obj = new Upload();

		$upload_obj->replaceConfig($config,$upload_path,$save_path);
		$return = $upload_obj->upload();

		$this->readExcel($full_path .$return['url']);
		
		die(json_encode(['data'=>$return,'message' => '上传成功','status' =>1]));
	}
	
	
	private function readExcel($filename){
		
		$company_id = Session::get('admin_id');
		$num = get_hash_table($company_id);

		//加载PHPExcel类
		vendor("PHPExcel.PHPExcel");
		
		//实例化PHPExcel类（注意：实例化的时候前面需要加'\'）
		$objReader = new \PHPExcel_Reader_Excel2007();
		
		if (!$objReader->canRead($filename)) {
			$objReader = new \PHPExcel_Reader_Excel5();
			if (!$objReader->canRead($filename)) {
				echo '不能读取文件';die();
			}
		}
		// $objReader->setLoadSheetsOnly('Sheet1');//只加载指定的sheet
		// $objPHPExcel=$objReader->load($filename);//加载文件	
		
		//加载文件
		$phpExcel = $objReader->load($filename);
		
		//获取指定的sheet
		$curSheet = $phpExcel->getSheet(0);

		$rowCount = $curSheet->getHighestRow(); //最大行数
		$colCount = $curSheet->getHighestColumn(); //最大列数

		$flag = ['0'=>'name','1'=>'phone','2'=>'email','3'=>'department'];
		
		$errorArr = [];
		for ($row = 2; $row <= $rowCount; $row++) {
				$value = [];
				for ($col = 'A'; $col <= $colCount; $col++) {
				   $tmp = $col . $row;       //excel 坐标
				   $k = ord($col) - 65;      //列对应关系
				   $value[$flag[$k]] = trim($curSheet->getCell($tmp)->getValue());
				}

				$validate_result = $this->validate($value, 'User');
				if($validate_result !== true){
					$errorArr[] = '第'.$row.'行'.$validate_result;
					continue;
				}
				$value['company_id'] = $company_id;
				$passData[] = $value;
		}
		
		$count = Db::name('company_member_'.$num)->insertAll($passData);

		$failCount = $rowCount - 1 -  $count;

		$successMsg = "导入成功".$count.'条记录';
		$errorMsg = '导入失败'.$failCount.'条记录,原因：'.implode(',',$errorArr);
		die(json_encode(['message' =>$successMsg.'<br />'.$errorMsg,'status'=> '0']));
		// if(($rowCount-1) ==  $count){
			// return true;
		// }
		// $objPHPExcel = $objReader->load($filename,$encode='utf-8');//获取excel文件

	}
}
