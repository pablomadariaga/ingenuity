@props(['listRoute' => null, 'listTitle' => 'List', 'action' => ''])
<div class="container">
    <div class="row justify-content-center mb-4">
        @if (session('status'))
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif
        @if (session('error'))
        <div class="col-md-12">
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        </div>
        @endif
        <div class="col-6">
            <h2>{{$title}}</h2>
        </div>
        @if ($listRoute)
        <div class="col-6 text-end">
            <a class="btn btn-primary" href="{{ $listRoute }}" role="button">{{$listTitle}}</a>
        </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">{{ $subTitle }}</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <form method="POST" action="{{$action}}" class="row">
                            @csrf
                            {{$slot}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
