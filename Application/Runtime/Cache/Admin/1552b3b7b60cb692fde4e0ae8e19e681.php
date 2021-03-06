<?php if (!defined('THINK_PATH')) exit();?><table id="AdminUser"></table>
<script>
$.Admin.User = {
	//组件ID
	'id' : '#AdminUser',

	//工具组件
	'tools' : [
		{ text: '查看', iconCls: 'fa fa-search', handler: function(){
                $.Admin.User.ViewUser();
            } 
        },
        { text: '添加', iconCls: 'fa fa-plus', handler: function(){
                $.Admin.User.AddUser();
            } 
        },
        { text: '编辑', iconCls: 'fa fa-edit', handler: function(){
                $.Admin.User.EditUser();
            } 
        },
        { text: '删除', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.User.DelUser();
            } 
        },
        { text: '重置密码', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.User.DelUser();
            } 
        },
        { text: '分类授权', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.User.DelUser();
            } 
        },
        { text: '角色授权', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.User.DelUser();
            } 
        },
        { text: '部门授权', iconCls: 'fa fa-remove', handler: function(){
                $.Admin.User.DelUser();
            } 
        }
	],

	//查看用户
	'ViewUser' : function(){
		var data = {};
        var get_select_row = $($.Admin.User.id).datagrid('getSelected');
        if(get_select_row == null){
            $.Admin.tips('温馨提示信息', '请先选择 您要删除的数据行','error');
            return false;
        }
        var id = $.Admin.random_dialog();
        $(id).dialog({
            title: '查看用户',
            iconCls: 'fa fa-search',
            queryParams: {id: get_select_row.uid},
            href: '<?php echo U("User/ViewUser");?>',
            modal: true,
            width: 500,
            onClose : function(){
                $(this).dialog("destroy");
            },
            onOpen : function(){
                var top = $(this).offset().top-$(this).position().top;
                $(this).dialog('resize',{
                    top: (top/2)+'px'
                });
            }
        });
	},

	//添加用户
	'AddUser' : function(){
        var id = $.Admin.random_dialog();
        $(id).dialog({
            title: '添加用户',
            iconCls: 'fa fa-plus',
            href: '<?php echo U("User/AddUser");?>',
            modal: true,
            width: 500,
            onClose : function(){
                $(this).dialog("destroy");
            },
            onOpen : function(){
                var top = $(this).offset().top-$(this).position().top;
                $(this).dialog('resize',{
                    top: (top/2)+'px'
                });
            }
        });
	},

	//字段格式化
	'formatter' : {
		'face' : function(value,row,index){
			if(value){
				return '<img src="'+value+'" style="padding:5px 0 0;" />';
			} else {
				return '<img src="http://placehold.it/30" style="padding:5px 0 0;" />';
			}
		},
		'sex' : function(value,row,index){
			switch(value){
				case '0' :
					return '<span class="text-danger">保密</span>';
					break;
				case '1' :
					return '<span class="text-primary">男</span>';
					break;
				case '2' :
					return '<span class="text-default">女</span>';
					break;
			}
		},
		'text' : function(value,row,index){
			if(value){
				return value;
			} else {
				return '<span class="text-danger">暂无</span>';
			}
		},
		'status' : function(value,row,index){
            if(parseInt(value)){
                return "<span class='fa fa-check text-primary'></span>";
            } else {
                return "<span class='fa fa-remove text-danger'></span>";
            }
        },
	}
}

$($.Admin.User.id).datagrid({
	title: '<?php echo ($Position); ?>',
    border: false,
    toolbar: $.Admin.User.tools,
    fitColumns: true,
    fit: true,
    ctrlSelect: true,
    singleSelect: false,
    rownumbers: true,
    idField: 'uid',
    url: "<?php echo U('User/Manage');?>",
    pagination:true,
	pagePosition:'bottom',
	pageNumber:1,
	pageSize:20,
	pageList:[10,20,30,50,100],
    columns:[[
        {field:'ck',checkbox:true},    
        {field:'uid',title:'ID',align:'center',width:20},
        //{field:'face',title:'头像',align:'center',formatter:$.Admin.User.formatter.face},
        {field:'username',title:'账号',align:'center',width:100},
        {field:'nickname',title:'昵称',align:'center',width:100},
        {field:'sex',title:'性别',align:'center',formatter:$.Admin.User.formatter.sex},
        {field:'birthday',title:'生日',align:'center'},
        {field:'email',title:'邮箱',align:'center',formatter:$.Admin.User.formatter.text},
        {field:'qq',title:'QQ',align:'center',formatter:$.Admin.User.formatter.text},
        {field:'mobile',title:'手机',align:'center',formatter:$.Admin.User.formatter.text},
        {field:'score',title:'积分',align:'center'},
        {field:'gold',title:'金币',align:'center'},
        {field:'status',title:'状态',align:'center',formatter:$.Admin.User.formatter.status},
        {field:'reg_ip',title:'注册IP',align:'center',formatter:$.Admin.User.formatter.ip},
        {field:'reg_time',title:'注册时间',align:'center',formatter:$.Admin.User.formatter.time},
        {field:'last_login_ip',title:'最后登录IP',align:'center',formatter:$.Admin.User.formatter.ip},
        {field:'last_login_time',title:'最后登录时间',align:'center',formatter:$.Admin.User.formatter.time}
    ]],
    onDblClickRow: function(row){
        $.Admin.User.ViewUser();
    },
    onRowContextMenu: function(e,index,data){
        e.preventDefault();//阻止浏览器捕获右键事件
        $(this).datagrid("unselectAll"); //取消所有选中项
        $(this).datagrid("selectRow", index); //根据索引选中该行
        $('#AdminUser_User').menu('show',{
            left: e.pageX,
            top: e.pageY
        });
    }
});
</script>
<div id="AdminUser_User" class="easyui-menu" style="display:none;">
    <div data-options="iconCls:'fa fa-folder-o'" onclick="$.Admin.Menu.ExpandMenu()">展开</div>
    <div data-options="iconCls:'fa fa-folder-open-o'" onclick="$.Admin.Menu.CollapseMenu()">收缩</div>
    <div data-options="iconCls:'fa fa-search'" onclick="$.Admin.Menu.ViewMenu()">查看</div>
    <div data-options="iconCls:'fa fa-plus'" onclick="$.Admin.Menu.AddMenu()">添加</div>
    <div data-options="iconCls:'fa fa-edit'" onclick="$.Admin.Menu.EditMenu()">编辑</div>
    <div data-options="iconCls:'fa fa-remove'" onclick="$.Admin.Menu.DelMenu()">删除</div>
    <div data-options="iconCls:'fa fa-sort'" onclick="$.Admin.Menu.SortMenu()">排序</div>
</div>