@extends('layouts.new-master')
@section('content')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 class="panel-title">
      <span class="glyphicon glyphicon-home"><a href="#" title=""> Home</a></span> 
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span><a href="#" title=""> Tin Tức</a>
      <span class="glyphicon glyphicon-chevron-right" style="font-size: 11px;"></span> <a href="#" title="">{!!$slug!!}</a>
    </h3>              
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding">              
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="panel panel-success">
            <div class="panel-body">
              <div class="row">
              <!-- hot new content -->
                <div class="col-lg-12">
                  <h3 class="title-h3"><a href="#" title="{!!$data->title!!}">{!!$data->title!!}</a></h3>
                   <p class="time-views"> <span> Đăng bởi: </span> <strong>{!!$data->author!!}</strong> <strong> - 106 lượt xem</strong></p>
                  <img class="img-new" src="{!!url('public/uploads/news/'.$data->images)!!}" alt="{!!$data->images!!}" >                  
                  <p class="summary-content">
                  <div class="panel-body">
                    <p class="text-left" style=" padding-bottom: 0px;">
                      <strong>
                        {!!$data->intro!!}
                      </strong>                  
                    </p>          
                      <div class="accordion-inner">
                        {!!$data->full!!}
                      </div>
                    <p class="text-left"><strong> Nguồn : <a target="#" href="#"> {!!$data->source!!}</a> </strong><br>
                      <span style="font-size:10px;color:#bdc3c7;">Sử lần cuối: {!!$data->updated_at!!} </span></p>
                      <p class="text-right"> <span class="glyphicon glyphicon-user" style="color:blue;"></span> <strong> {!!$data->author!!} </strong></p>
                  </div>
                  </p>
                </div>                
              </div>
              <div class="row">
                <?php 
                    $data = DB::table('news')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5); 
                  ?>
                <h1 style="padding-left: 20px;"> Tin khác</h1>
                <hr>
                @foreach($data as $row)
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                      <a href="{!!url('/khuyenmai/'.$row->id.'-'.$row->slug)!!}" title="{!!$row->title!!}"><img src="{!!url('public/uploads/news/'.$row->images)!!}" alt="{!!$row->title!!}" width="90%" height="99%"> </a>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      <h4><a href="{!!url('/khuyenmai/'.$row->id.'-'.$row->slug)!!}"" title="{!!$row->title!!}">{!!$row->title!!}</a></h4>
                      <p> 
                        {!!$row->intro!!}
                      </p>
                      <p><strong>Lúc :</strong> {!!$row->created_at!!} Bởi : <strong>{!!$row->author!!} </strong></p>
                    </div>
                  </div> 
                @endforeach 
              </div><!-- /row -->
              {!!$data->render()!!}
            </div>
          </div>   
        </div>
      </div>     
    </div> 
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">            
       <!-- panel inffo 1 -->
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title text-center">Sản phẩm mới</h3>
        </div>
        <div class="panel-body no-padding">
        <?php 
          $giaynam = DB::table('products')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->join('pro_details', 'pro_details.pro_id', '=', 'products.id')
                ->where('category.parent_id','=','1')
                ->select('products.*','pro_details.size','pro_details.mau','pro_details.rate','pro_details.soluong')
                ->orderBy('products.created_at', 'desc')
                ->paginate(3); 

        ?>
        @foreach($giaynam as $row)
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
            <div class="thumbnail mobile">              
              <div class="bt">
                <div class="image-m pull-left">
                  <img class="img-responsive" src="{!!url('public/uploads/products/'.$row->images)!!}" alt="{!!$row->name!!}">
                </div>
                <div class="intro pull-right">
                  <h1><small class="title-mobile">{!!$row->name!!}</small></h1>
                  <li>{!!$row->intro!!}</li>
                  <span class="label label-info">Khuyễn mãi</span>   
                  @if ($row->promo1!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo1!!}</li>
                  @elseif($row->promo2!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo2!!}</li>
                  @elseif ($row->promo3!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo3!!}</li>
                  @endif 
                    <li><span class="glyphicon glyphicon-ok-sign"></span></li> 
                </div><!-- /div introl -->
              </div> <!-- /div bt -->
              <div class="ct">
                <a href="{!!url('giaynam/'.$row->id.'-'.$row->slug)!!}" title="Chi tiết">
                  <span class="label label-info">Ưu đãi khi mua</span>   
                  @if ($row->promo1!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo1!!}</li>
                  @elseif($row->promo2!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo2!!}</li>
                  @elseif ($row->promo3!='')
                    <li><span class="glyphicon glyphicon-ok-sign"></span>{!!$row->promo3!!}</li>
                  @endif 
                    <li><span class="glyphicon glyphicon-ok-sign"></span></li> 
                  <span class="label label-warning">Thông tin sản phẩm</span> 
                  <li><strong>Size</strong> : <i>{!!$row->size!!}</i></li>
                  <li><strong>Color </strong> : <i>{!!$row->mau!!}</i></li>
                  <li><strong>Rate</strong> : <i>{!!$row->rate!!}</i></li>
                  <li><strong>Số lượng</strong> : <i>{!!$row->soluong!!} </i></li> 
                </a>
              </div>
                <span class="btn label-warning"><strong>{!!number_format($row->price)!!}</strong>Vnd </span>
                <a href="{!!url('goa-hang')!!}" class="btn btn-success pull-right add">Thêm vào giỏ </a>
            </div> <!-- / div thumbnail -->
          </div>  <!-- /div col-4 -->
        @endforeach        

        </div>
      </div> <!-- /panel info 2  quản cáo 1          -->
    <!-- panel info 2  quản cáo 1          -->          
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Sự kiện HOT</h3>
      </div>
      <div class="panel-body no-padding">
      <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner1.jpg')!!}" alt="" width="100%" height="100%"> </a> <br>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner2.jpg')!!}" alt="" width="100%" height="100%"> </a> <br>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner3.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner4.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner5.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner6.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner7.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner8.jpg')!!}" alt="" width="100%" height="100%"> </a>
        <a href="#" title=""><img src="{!!url('public/images/slides/thumbs/banner9.jpg')!!}" alt="" width="100%" height="100%"> </a>
      </div>
    </div> <!-- /panel info 2  quản cáo 1          -->        
     <!-- /panel info 2  quản cáo 1          -->  
     <!-- fan pages myweb -->
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Fans Pages</h3>
      </div>
      <div class="panel-body">
        Hãy <a href="#" title="">Like</a> facebook của NTSHOP để cập nhật tin mới nhất
      </div>
    </div> <!-- /fan pages myweb -->        
  </div> 
</div>
<!-- ===================================================================================/news ============================== -->
@endsection