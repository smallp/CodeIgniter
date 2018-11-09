基于最新3.1CI分支修改。

## 减少的功能：
* 禁用了hook
* 禁用了控制器和模型的扩展
* 删除了部分不常用的类库

## 增加的功能
* restful支持：  
对于/c/foo请求，不同的http请求对应c控制器里面不同的方法
	* get请求对应foo方法，其他选项，如页码、筛选等参数在get参数里面
	* put请求对应modFoo方法，后面跟对应资源的id，如put /c/book/1 指修改id为1的书的信息。
	* Post对应addFoo方法
	* delete对应del方法，类似put，后面跟需要删除资源的id  
对于要删除多个资源的情况，那么把对应资源id作为参数即可，不放在url中。
	* 返回均使用restful函数，restfl($code=204,$data='操作成功！')。code为返回的http状态码，data为返回的数据，函数内自动json_encode。
	* 如果是put或者delete请求，需要获取数据，调用input->put方法。参数同post。
* 数据库相关：  
	* 表缓存，可以使用db->create(table)函数获取input信息。
	* db->find(table,value,colum='id',select='*')，模仿TP框架的find方法查询一条记录。  
	Eg. db->find('account',1)返回id为1的人的所有信息
	* db->step($table,$key,$isInc=TRUE,$num=1)，where参数需要先指定。
	* db->between($key,$v1,$v2)，CI的between方法
* 内置smarty模板引擎，直接$this->load->view(tplNmae,values)。不支持assign，需要传入的数据需要处理好后调用此接口传入。
* MyException类，发生预期错误后抛出此异常。  
Eg. throw new MyException('',MyException::DATABASE);前面为字符串，表示错误信息，有默认值。后面为错误类型，详见/system/core/common。
* input类中，参数添加默认值。  
Eg. get($index = NULL, $xss_clean = FALSE,$default=NULL)，其他方法同。
* 所有的数据库操作都会记录在日志中，错误日志与普通日志分开存储。
* 内置log类添加开关，可以通过
```
		$log =& load_class('Log', 'core');
		$log->setDisable(false);
```
来开关。