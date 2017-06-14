$(function () {

  initDatePick();
  //客户列表页 日期时间选择
  function initDatePick() {
    var config = {
      mode: 2, //时间选择器模式：1：年月日，2：年月日时分（24小时），3：年月日时分（12小时），4：年月日时分秒。默认：1
      format: 2, //时间格式化方式：1：2015年06月10日 17时30分46秒，2：2015-05-10  17:30:46。默认：2
      years: [2000, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017], //年份数组
      nowbtn: true, //是否显示现在按钮
      onOk: function () {
        //alert('OK');
      },  //点击确定时添加额外的执行函数 默认null
      onCancel: function () {
        //alert('A');
      }, //点击取消时添加额外的执行函数 默认null
    }

    $('#picktime, #picktime2').mdatetimer(config);
  }

});
