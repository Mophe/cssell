13栋7楼售货管理系统
====================================

功能模块
------------------------------------
	
	商品模块
	订单模块
	通知模块
	建议模块
	记账模块

接口规范(参数，返回值)
--------
###login
	{'username'=>'a','password'=>'a'} {'result'=>true}
###checkLogin
	{} {'result'=>true}
###addUser
	{'username'=>'a','password'=>'a'} {'result'=>true}
###getUsers
	{} [{'username'=>'a'}]
###deleteUser
	{'username'=>'a'} {'result'=>true}
###getCommodities
	{} [{'name'=>'a','price'=>1,'introduction'=>'haha'}]
###addCommodity
	{'name'=>'a','price'=>1,'introduction'=>'haha'} {'result'=>true}
	

