<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if(isset($left_title))
                <h4 class="mb-sm-0 font-size-18">{{ $left_title }}</h4>
            @endif
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="">{{ $li_1 }}</a></li>
                    @if(isset($li_2))
                        <li class="breadcrumb-item"><a href="{{ $li_2_link }}">{{ $li_2 }}</a></li>
                    @endif
                    @if(isset($li_3))
                        <li class="breadcrumb-item"><a href="{{ $li_3_link }}">{{ $li_3 }}</a></li>
                    @endif
                    @if(isset($title))
                        <li class="breadcrumb-item active">
                            @if(isset($title_link))
                                <a href="{{ $title_link }}">{{ $title }}</a>
                            @else
                                {{ $title }}
                            @endif
                        </li>
                    @endif
                    @if(isset($subtitle))
                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
