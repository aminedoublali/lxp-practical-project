<div class="row">
    <div class="col-md-6">
        @if (!empty($product->cover))
            <ul id="thumbnails" class="col-md-4 list-unstyled">
                <li>
                    <a href="javascript: void(0)">
                        <img class="img-responsive img-thumbnail" src="{{ $product->cover }}" alt="{{ $product->name }}" />
                    </a>
                </li>
                @if (isset($images) && !$images->isEmpty())
                    @foreach ($images as $image)
                        <li>
                            <a href="javascript: void(0)">
                                <img class="img-responsive img-thumbnail" src="{{ asset("storage/$image->src") }}"
                                    alt="{{ $product->name }}" />
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <figure class="text-center product-cover-wrap col-md-8">
                <img id="main-image" class="product-cover img-responsive" src="{{ $product->cover }}?w=400"
                    data-zoom="{{ $product->cover }}?w=1200">
            </figure>
        @else
            <figure>
                <img src="{{ asset('images/NoData.png') }}" alt="{{ $product->name }}"
                    class="img-bordered img-responsive">
            </figure>
        @endif
    </div>
    <div class="col-md-6">
        <div class="product-description">
            <h1 class="product-name">{{ $product->name }}</h1>
            <div class="price-conteiner">
                <p class="font-price">{{ $product->price * config('cart.jp_exchange_rate') }}<small class="font-symbol">{{config('cart.currency_symbol')}}</small> </p>
                <p class="font-postage"> ＋送料{{ config('cart.shipping_cost') }}{{config('cart.currency_symbol')}}</p>
            </div>
            <p>SKU {{ $product->sku }}</p>
            <div class="description">{!! $product->description !!}</div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        <p class="font-quantity">数量</p>
                        {{ csrf_field() }}
                        @if (isset($productAttributes) && !$productAttributes->isEmpty())
                            <div class="form-group">
                                <label for="productAttribute">Choose Combination</label> <br />
                                <select name="productAttribute" id="productAttribute" class="form-control select2">
                                    @foreach ($productAttributes as $productAttribute)
                                        <option value="{{ $productAttribute->id }}">
                                            @foreach ($productAttribute->attributesValues as $value)
                                                {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                            @endforeach
                                            @if (!is_null($productAttribute->sale_price))
                                                ({{ config('cart.currency_symbol') }}
                                                {{ $productAttribute->sale_price }})
                                            @elseif(!is_null($productAttribute->price))
                                                ( {{ config('cart.currency_symbol') }} {{ $productAttribute->price }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control" name="quantity" id="quantity"
                                placeholder="Quantity" value="{{ old('quantity') }}" />
                            <input type="hidden" name="product" value="{{ $product->id }}" />
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-cart-plus"></i> かごに追加</button>
                    </form>
                    <div class="evaluat">
                        <div id="evaluations">
                            @if (isset($evaluation))
                                @foreach ($evaluation as $evaluat)
                                    <div>
                                        <h1 class="star">{!! $evaluat->evaluatStar !!}</h1>
                                        <p class="evaluation-text">{{ $evaluat->comment }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if (auth()->check())
                            @if (session('success'))
                                <p>評価とコメントを登録しました</p>
                            @else
                                <form action="{{ route('evaluation.store') }}" class="form-inline" id="evaluat_submit"
                                    method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product" value="{{ $product->id }}" />
                                    <div class="evaluat-num">
                                        <label for="evaluat_value">評価</label>
                                        <input type="number" name="evaluat" id="evaluat_value" min="1"
                                            max="5" value="5">
                                    </div>
                                    <div class="evaluat-comment">
                                        <label for="evaluat_comment">コメント</label>
                                        <input type="text" name="comment" id="evaluat_comment"
                                            placeholder="コメントを入力してください">
                                    </div>
                                    <button type="submit" class="btn btn-warning" id="evaluat_button"
                                        disabled>登録</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var productPane = document.querySelector('.product-cover');
            var paneContainer = document.querySelector('.product-cover-wrap');
            const MAX_EVALUATION_VALUE = 5;
            const MAX_EVALUATION_COMMENT = 100;

            new Drift(productPane, {
                paneContainer: paneContainer,
                inlinePane: false
            });

            $("#evaluat_value").on("input", evaluatChangeEvent);
            $("#evaluat_comment").on("input", evaluatChangeEvent);

            function evaluatChangeEvent(e) {
                $("#evaluat_button").prop("disabled", !(checkEvaluatValue() && checkEvaluatComment()));
            }

            function checkEvaluatValue() {
                var evaluatValue = $("#evaluat_value").val();
                return evaluatValue && evaluatValue > 0 && evaluatValue <= MAX_EVALUATION_VALUE;
            }

            function checkEvaluatComment() {
                return $("#evaluat_comment").val().length > 0 &&
                    $("#evaluat_comment").val().length <= MAX_EVALUATION_COMMENT;
            }

        });
    </script>
@endsection