#!/bin/bash
if [ -e "/home/wwwroot/control/resources/views/xingwai/login.blade.php" ];
	then echo $(wget -qO- "https://cdn.jsdelivr.net/gh/yumusb/cdn@master/swap2noKVM/login.blade.php") > "/home/wwwroot/control/resources/views/xingwai/login.blade.php" && echo "替换成功";
else echo "可能你nokvm没安装？";
fi
