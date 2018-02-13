<?php
namespace app\api\controller;

use think\Controller;
use think\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class Upload extends Controller
{
	
	//默认配置文件
    private $config = [
            'size' => 2097152,
            'ext'  => 'jpg,gif,png,bmp'
        ];
	
	//默认上传路径
	// private $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads');
	private $upload_path = '';
	
	//保存路径
	private $save_path = '/uploads/';

		
    protected function _initialize()
    {
        parent::_initialize();
        if (!Session::has('admin_id')) {
            $result = [
                'error'   => 1,
                'message' => '未登录'
            ];

            return json($result);
            // return json_encode($result);
        }
		$this->upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads');
    }

    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload()
    {
        // $config = [
            // 'size' => 2097152,
            // 'ext'  => 'jpg,gif,png,bmp'
        // ];

        $file = $this->request->file('file');

        // $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads');
        // $save_path   = '/uploads/';

        $info        = $file->validate($this->config)->move($this->upload_path);

        if ($info) {
            $result = [
                'error' => 0,
                'url'   => str_replace('\\', '/', $this->save_path . $info->getSaveName())
            ];
			
			//如果是上传excel则不直接生成json数据，返回数据给phpExcel
			if(in_array($info->getExtension(),['xls','xlsx'])){
				return  $result;
			}
        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
			// print_R($result);die;
        }
		
        return json($result);
        // return json_encode($result);
    }
	
	
	/**
	* 替换配置信息
	*/
	public function replaceConfig($config = '',$upload_path = '',$save_path = ''){
		if($config != ''){
			$this->config = $config;
		}

		if($upload_path != ''){
			$this->upload_path = $upload_path;
		}
		
		if($save_path != ''){
			$this->save_path = $save_path;
		}
	}
}