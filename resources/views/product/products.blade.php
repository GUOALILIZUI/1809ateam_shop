@foreach($arrDataInfo as $k=>$v)
    <div class="col s6">
        <div class="content">
            <img src="/goodsimg/{{$v->goods_img}}" alt="">
            <h6><a href="shopSingle?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a></h6>
            <div class="price">
                现价:${{$v->goods_selfprice}}<span>原价:${{$v->goods_marketprice}}</span>
            </div>
            <button class="btn button-default" goods_id={{$v->goods_id}}>加入购物车</button>
            &nbsp&nbsp&nbsp&nbsp&nbsp;<button class="button-default wish" goods_id={{$v->goods_id}}>加入收藏❤</button>
        </div>
    </div>
@endforeach