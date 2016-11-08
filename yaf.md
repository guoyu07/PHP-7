## yaf 使用心得 ##

1.yaf中使用__get魔术方法后，直接导致模板不能自动渲染，需要手动指定模板


	$this->getView()->display('index/index.html');
 

2.如果需要关闭模板自动渲染, 可以在BootStrap.php的__init**方法或者在控制器的init()方法中添加如下：

	Yaf_Dispatcher::getInstance()->autoRender(FALSE); // 关闭自动加载模板
 

3.yaf内部是默认自动渲染模板的，YafAutoRender默认为1；yaf使用__get魔术方法后，每次都会获取一个属性YafAutoRender, 但是默认在类中是找不到这个属性的，所以__get的时候会将YafAutoRender置为NULL，模板就不会再自动渲染；解决方案是，在类的init方法中手动自定义该属性


	$this->yafAutoRender = true;
 

这样，再次使用__get时，php就会检测到该类存在这个属性，实现模板自动渲染。