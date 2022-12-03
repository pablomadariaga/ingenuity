@props(['action' => ''])
<div class="w-100 h-100 d-flex flex-row container-fluid">
    <div class="W-100 flex-grow-1 d-flex align-items-center">
        <div class="row flex-grow-1">
            <div class="col-lg-6 col-xl-4 col-md-8 mx-auto">
                <div class="text-bg-light p-md-5 p-4 shadow">
                    <div class="mb-4">
                        <x-application-logo class="w-160px w-md-180px w-lg-220px h-auto" />
                    </div>
                    @isset($title)
                    <h5 class="fw-semibold">{{ $title }}</h5>
                    @endisset
                    @isset($description)
                    <h6 class="fw-light">{{ $description }}</h6>
                    @endisset
                    <form method="POST" action="{{$action}}" class="pt-3">
                        @csrf
                        {{$slot}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

