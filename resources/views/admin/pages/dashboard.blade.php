@extends('admin.layouts.app')
@section('title')
Dashboard
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-4">
    <h2><i class="fa fa-home" aria-hidden="true"></i> Dashboard</h2>
  </div>
</div>

<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-promocode_count bg-darken-2">
                            <i class="fa fa-bullhorn fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-promocode_count white media-body">
                            <h3>Promotions</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalPromotions}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.promotions.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-ExclusiveOffer_count bg-darken-2">
                            <i class="fa fa-gift fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-ExclusiveOffer_count white media-body">
                            <h3>Exclusive Offer</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalExclusiveOffer}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.exclusiveoffer.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-Location_count bg-darken-2">
                            <i class="fa fa-map-marker fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-Location_count white media-body">
                            <h3>Location</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalLocation}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.location.index')  }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-Users_count bg-darken-2">
                            <i class="fa fa-arrows fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-Users_count white media-body">
                            <h3>Total Users</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalToken}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.token.index') }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-12 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-Notification_count bg-darken-2">
                            <i class="fa fa-bell fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-Notification_count white media-body">
                            <h3>Notification</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalNotification}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.notification.index') }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-User_Notification_count bg-darken-2">
                            <i class="fa fa-users fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-User_Notification_count white media-body">
                            <h3>User Notification</h3>
                            <h5 class="text-bold-400 mb-0">{{$totalTransaction}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ route('admin.transaction.index') }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-Setting_count bg-darken-2">
                            <i class="fa fa-cog fa-3x icon_admin"></i>
                        </div>
                        <div class="p-2 bg-gradient-x-Setting_count white media-body">
                            <h3>Setting</h3>
                            <h5 class="text-bold-400 mb-0"> {{$totalSetting}}</h5>
                            <div class="media-left media-middle mt-1">
                                <a class="white" href="{{ url('admin/settings') }}">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  </div>


  <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            <div  id="dynamic_data"></div>
            <div id="dashboard_div" style="margin: 2em; " style="width:250px;height:250px;">
                <table>
                    <tr>
                        <td><div id="control3" align="center"></div></td>
                    </tr>
                </table>
                <div id="chart2" align="center"></div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('styles')
<style type="text/css">
  .bg-promocode_count{background-color: #8803fc !important;}
  .bg-gradient-x-promocode_count{background-image: linear-gradient(to right, #8803fc 0%, #cf9afe 100%); background-repeat: repeat-x;}
  .bg-ExclusiveOffer_count {background-color: #FF5733!important;}
  .bg-gradient-x-ExclusiveOffer_count {background-image: linear-gradient(to right, #FF5733 0%, #ed836b 100%); background-repeat: repeat-x;}
  .bg-Location_count {background-color: #10C888 !important;}
  .bg-gradient-x-Location_count {background-image: linear-gradient(to right, #10C888 0%, #5CE0B8 100%); background-repeat: repeat-x;}
  .bg-Users_count {background-color: #fcbe03!important;}
  .bg-gradient-x-Users_count {background-image: linear-gradient(to right, #fcbe03 0%, #fdd868 100%); background-repeat: repeat-x;}
  .bg-Notification_count {background-color: #00A5A8 !important;}
  .bg-gradient-x-Notification_count {background-image: linear-gradient(to right, #00A5A8 0%, #4DCBCD 100%); background-repeat: repeat-x;}
  .bg-User_Notification_count {background-color: #FF6275 !important;}
  .bg-gradient-x-User_Notification_count {background-image: linear-gradient(to right, #FF6275 0%, #FF9EAC 100%); background-repeat: repeat-x;}
  .bg-Setting_count {background-color: #4b5ff1!important;}
  .bg-gradient-x-Setting_count {background-image: linear-gradient(to right, #4b5ff1 0%, #6CDDEB 100%); background-repeat: repeat-x;}
  h3{font-size: 13px;}
  .wrapper-content{padding: 20px 10px 40px;}
  .white{color:#FFF;}
  .white:hover{color:#FFF;}
  .card{color:#FFF!important; font-weight: 600!important; font-size: 1.14rem!important;}
  .p-2 {padding: 1rem!important;}
  #dynamic_data {margin: 2em auto;}
  .fa-3x {font-size: 3em;}
</style>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script type="text/javascript">
  Highcharts.chart('dynamic_data', {
    chart: {
      type: 'variablepie',
      backgroundColor: null
    },title: {
      text: ''
    },exporting: {
      enabled: false 
    },tooltip: {
      headerFormat: '',
      pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name} : {point.y}</b><br/>'
    },series: [{
      minPointSize: 80,
      innerSize: '30%',
      zMin: 0,
      name: 'Testing',
      data: [{
        name: 'Promotions : {{$totalPromotions}}',
        y: {{$totalPromotions}},
        color : '#8803fc',
      },{
        name: 'Exclusive Offer : {{$totalExclusiveOffer}}',
        y: {{$totalLocation}},
        color : '#FF5733',
      },{
        name: 'Location : {{$totalLocation}}',
        y: {{$totalLocation}},
        color : '#10C888',
      },{
        name: 'Total Users : {{$totalToken}}',
        y: {{$totalToken}},
        color : '#fcbe03',
      },{
        name: 'Notification : {{$totalNotification}}',
        y: {{$totalNotification}},
        color : '#00A5A8',
      },{
        name: 'User Notification : {{$totalTransaction}}',
        y: {{$totalTransaction}},
        color : '#FF6275',
      },{
        name: 'Setting : {{$totalSetting}}',
        y: {{$totalSetting}},
        color : '#4b5ff1',
      },]
    }]
  });
</script>
@endsection