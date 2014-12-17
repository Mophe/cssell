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
结果中自带result属性，若在下文中提及result属性，则表明数据返回只有此属性，若未提及，则表明此返回数据包含data属性，属性值如下
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
###deleteCommodity
	{'name'=>'a'} {'result'=>true}
###addOrder
	{'name'=>'a','phone'=>13000000000,'commodities'=>[{'name'=>'a','price'=>1,'number'=>1}],'content'=>'haha'}
###getOrder
	{} {'id'=>1,'name'=>'a','phone'=>13000000000,'content'=>'haha','price'=>123,'time'=>'2014-12-12 00:00:00'}
###getOrderDetails
	{'order_id'=>1} [{'commodity'=>'a','price'=>1,'number'=>1}]
###deleteOrder
	{'order_id'=>1} {'result'=>true}
###getNotice
	{} {'content'=>'haha'}
###modifyNotice
	{'content'=>'haha'} {'result'=>true}
###addBill
	{'money'=>100,'introduction'=>'haha'} {'result'=>true}
###modifyBill
	{'bill_id'=>1,'money'=>100,'introduction'=>'haha'} {'result'=>true}
###deleteBill
	{'bill_id'=>1} {'result'=>true}
###getBills
	{} [{'id'=>1, 'money'=>100,'time'=>'2014-12-12','introduction'=>'haha'}]
###countMoney
	{'start'=>'2014-01-01','end'=>'2014-12-31'} {'money'=>1000}

