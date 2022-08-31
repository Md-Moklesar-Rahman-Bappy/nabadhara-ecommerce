@extends('frontend.layouts.app')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini p-4">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ translate('Wishlist')}}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section pt-5">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive wishlist_table">
                    @if ($wishlists->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-stock-status">Stock Status</th>
                                    <th class="product-add-to-cart"></th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlists as $key => $wishlist)
                                    @if ($wishlist->product != null)
                                        <tr id="wishlist_{{ $wishlist->id }}">
                                            <td class="product-thumbnail"><a href="{{ route('product', $wishlist->product->slug) }}"><img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" alt=""></a></td>
                                            
                                            <td class="product-name" data-title="Product"><a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->getTranslation('name') }}</a></td>
                                            
                                            <td class="product-price" data-title="Price">{{ home_discounted_base_price($wishlist->product->id) }}</td>
                                            
                                            <td class="product-stock-status" data-title="Stock Status">
                                                @php
                                                    $qty = 0;
                                                    if($wishlist->product->variant_product){
                                                        foreach ($product->stocks as $key => $stock) {
                                                            $qty += $stock->qty;
                                                        }
                                                    }
                                                    else{
                                                        $qty = $wishlist->product->current_stock;
                                                    }
                                                @endphp
                                                @if ($qty > 0)
                                                    <span class="badge badge-pill badge-success">{{ translate('In-Stock')}}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ translate('Out of Stock')}}</span>
                                                @endif
                                            </td>
                                            
                                            <td class="product-add-to-cart"><a href="javascript:void(0)" class="btn btn-fill-out"  onclick="showAddToCartModal({{ $wishlist->product->id }})"><i class="icon-basket-loaded"></i> Add to Cart</a></td>
                                            
                                            <td class="product-remove" data-title="Remove"><a href="javascript:void(0)" onclick="removeFromWishlist({{ $wishlist->id }})"><i class="ti-close"></i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $wishlists->links() }}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <p class="fs-17">{{ translate('Your wishlist is empty')}}</p>
                        </div>
                    @endif
                	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

@endsection

@section('modal')
    
@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                AIZ.plugins.notify('success', '{{ translate('Item has been renoved from wishlist') }}');
            })
        }
    </script>
@endsection
