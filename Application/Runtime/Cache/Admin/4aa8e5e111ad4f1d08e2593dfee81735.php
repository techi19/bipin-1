<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <script type="text/javascript" src="/static/a/resource/js/jquery.js"></script>
    <script type="text/javascript" src="/static/a/resource/js/jquery.validation.min.js"></script>
    <script type="text/javascript" src="/static/a/resource/js/admincp.js"></script>
    <script type="text/javascript" src="/static/a/resource/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/static/a/layer/layer.js"></script>
    <script type="text/javascript" src="/static/a/resource/js/common.js" charset="utf-8"></script>
    <!--<script type="text/javascript" src="/static/a/home/js/common.js" charset="utf-8"></script>-->
<!--<script type="text/javascript" src="http://www.jeasyui.net/Public/js/easyui/jquery.easyui.min.js"></script>不知道干啥的-->
    <link href="/static/a/default/css/skin_0.css" rel="stylesheet" type="text/css" id="cssfil2" />
    <link href="/static/a/default/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="/static/a/default/css/font/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
<link href="/static/a/resource/easyui.css" rel="stylesheet" type="text/css" id="cssfile2" />
<link href="/static/a/resource/icon.css" rel="stylesheet" type="text/css" id="cssfile" />
<!--<script type="text/javascript" src="/static/a/resource/jquery-1.4.4.min.js"></script>-->

<!--js-->

<script src="/static/a/resource/lib/js/jquery.iDialog.js" ></script>
<script src="/static/a/resource/lib/js/drag.js"></script>

<script>


    $(function(){

        $('.drag-box-3 .drag').each(function(index){
            $(this).myDrag({
                randomPosition:true,
                direction:'all',
                handler:false
            });
        });

    });
</script>
</head>
<body>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<!-- 模板内容开始 -->




<link href="/static/a/default/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/static/a/default/css/font/font-awesome/css/font-awesome-ie7.min.css">

<div class="page">
<div class="fixed-bar">
    <div class="item-title">
        <h3>戏币充值管理</h3>
        <ul class="tab-base">
            <li><a href="<?php echo U('xibi');?>" <?php if(empty($classification)): ?>class="current"<?php endif; ?>><span>全部分类</span></a></li>

            <li><a href="<?php echo U('addxibi');?>"><span>添加</span></a></li>
        </ul>
    </div>
</div>
<div class="fixed-empty"></div>


<form method='post' id="form_apply" action="">
    <style>

        #newslist img{
            width:80px;
            height:60px;
        }
    </style>
    <table class="table tb-type3" id="newslist">
        <thead>
        <tr class="thead">
            <th class="w12">ID</th>
            <th class="w60">内购的id</th>
            <th class="w60">戏币数量</th>
            <th class="w60">价格/元</th>
            <th class="w60">单价</th>
            <th class="w60">排序</th>

            <th class="w108 align-center">操作</th>
        </tr>
        </thead>
        <tbody>
            <?php if(empty($list)): ?><tr>
                    <td colspan="10" style="text-align: center;">
                        无记录
                    </td>
                </tr><?php endif; ?>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($news["id"]); ?></td>
                    <td><?php echo ($news["pingid"]); ?></td>
                    <td><?php echo ($news["nums"]); ?></td>
                    <td><?php echo ($news["gold"]); ?></td>
                    <td><?php echo ($news["vip_title"]); ?></td>

                    <td><?php echo ($news["toop"]); ?></td>

                    <td>
                        <a class="btn" href="<?php echo U('addxibi',array('id'=>$news['id']));?>"><span>编辑</span></a>
                        <a class="btn del" href="<?php echo U('xibi_delete',array('id'=>$news['id']));?>"><span>删除</span></a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        <tr style="display:none;">
            <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="tfoot">

            <td colspan="15">
                &nbsp;&nbsp;
                <?php echo ($pages); ?>

            </td>
        </tr>
        </tfoot>
    </table>
</form>
</div>

<script type="text/javascript" src="/static/a/resource/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="/static/a/resource/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="/static/a/resource/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/static/a/resource/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
    var SITEURL = "/";
    $(function(){
        //商品分类
        //init_gcselect('gc_choose_json','gc_json');
        /* AJAX选择品牌 */
        //$("#ajax_brand").brandinit();

        $('#ncsubmit').click(function(){
            $('input[name="op"]').val('goods');$('#formSearch').submit();
        });

        // 违规下架批量处理
        $('a[nctype="lockup_batch"]').click(function(){
            str = getId();
            if (str) {
                goods_lockup(str);
            }
        });

        // ajax获取商品列表
        $('i[nctype="ajaxGoodsList"]').toggle(
                function(){
                    $(this).removeClass('icon-plus-sign').addClass('icon-minus-sign');
                    var _parenttr = $(this).parents('tr');
                    var _commonid = $(this).attr('data-comminid');
                    var _div = _parenttr.next().find('.ncsc-goods-sku');
                    if (_div.html() == '') {
                        $.getJSON('index.php?act=goods&op=get_goods_list_ajax' , {commonid : _commonid}, function(date){
                            if (date != 'false') {
                                var _ul = $('<ul class="ncsc-goods-sku-list"></ul>');
                                $.each(date, function(i, o){
                                    $('<li><div class="goods-thumb" title="商家货号：' + o.goods_serial + '"><a href="' + o.url + '" target="_blank"><image src="' + o.goods_image + '" ></a></div>' + o.goods_spec + '<div class="goods-price">价格：<em title="￥' + o.goods_price + '">￥' + o.goods_price + '</em></div><div class="goods-storage">库存：<em title="' + o.goods_storage + '">' + o.goods_storage + '</em></div><a href="' + o.url + '" target="_blank" class="ncsc-btn-mini">查看商品详情</a></li>').appendTo(_ul);
                                });
                                _ul.appendTo(_div);
                                _parenttr.next().show();
                                // 计算div的宽度
                                _div.css('width', document.body.clientWidth-54);
                                _div.perfectScrollbar();
                            }
                        });
                    } else {
                        _parenttr.next().show()
                    }
                },
                function(){
                    $(this).removeClass('icon-minus-sign').addClass('icon-plus-sign');
                    $(this).parents('tr').next().hide();
                }
        );
    });

    // 获得选中ID
    function getId() {
        var str = '';
        $('#form_goods').find('input[name="id[]"]:checked').each(function(){
            id = parseInt($(this).val());
            if (!isNaN(id)) {
                str += id + ',';
            }
        });
        if (str == '') {
            return false;
        }
        str = str.substr(0, (str.length - 1));
        return str;
    }

    // 商品下架
    function goods_lockup(ids) {
        _uri = "/index.php?act=goods&op=goods_lockup&id=" + ids;
        CUR_DIALOG = ajax_form('goods_lockup', '违规下架理由', _uri, 350);
    }
</script>




<!-- 模板内容结束 -->
</body>
</html>