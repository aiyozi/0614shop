<?php
/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
 function upload($file){
    $file=request()->$file;
    if($file->isValid()){
        
        $path=$file->store("uploads");
        return $path;
    }
    exit("文件上传错误");
}
 function Maxupload($img){
    $file=request()->$img;
    foreach($file as $k=>$v){
        if($v->isValid()){
            $path[$k]=$v->store("uploads");
        }else{
            $path[$k]="文件上传错误";
        }
        
    }
    return $path;
    
}
function getcateinfo($data,$prent_id=0,$level=0){
    // 判断如果￥data没有值直接返回
    if(!$data){
        return;
    }
    static $na=[];
    // 有数据foreach
    foreach($data as $v){
        // 判断祖先及分类是否相等
        if($v->prent_id==$prent_id){
            // 如果相当给他增加层级关系
            $v->level=$level;
            $na[]=$v;
            // $data相当于$cate    $v->cart_name是祖先级分类下的子孙级  $level是层级关机+1
            getcateinfo($data,$v->cart_id,$level+1);
        }
    }
    return $na;
}
    function json($code,$msg){
        $data=[
            "code"=>$code,
            "msg"=>$msg,
        ];
        echo json_encode($data);die;
    }

?>