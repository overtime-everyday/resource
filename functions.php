<?php

    //递归获取指定目录下的目录
    function get_all_file($path){
        if($path != '.' && $path != '..' && is_dir($path)){
            $files = [];
            if($handle = opendir($path)){
                while($file = readdir($handle)){
                    if($file != '.' && $file != '..'){
                        $file_name = ($path . DIRECTORY_SEPARATOR . $file);
                        if(is_dir($file_name)){
                            $files[$file] = $this->get_all_file($file_name);
                        }else{
                            $files[] = $path;
                        }
                    }
                }
            }
        }
        closedir($handle);
        return $this->multiArrayToOne($files);
    }
    //多维数组转一维数组，并去重
    public function multiArrayToOne($multi)
    {
        $arr = array();
        foreach ($multi as $key => $val) {
            if (is_array($val)) {
                $arr = array_merge($arr, $this->multiArrayToOne($val));
            } else {
                $arr[] = $val;
            }
        }
        return array_unique($arr);
    }
