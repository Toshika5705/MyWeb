@extends('layouts.app')

@section('protfolio')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>{{ __('messages.cards') }}<h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary" data-title="A" onclick="openForm('A')">{{ __('messages.add') }}</button>
                        </div>
                    </div>
                </div>

                <!-- 顯示分頁內容 -->
                <div class="container  mt-4">
                    <div class="row">
                        @foreach($data as $item)
                            <div class="col-md-6">
                                <div class="card mb-12" style="width: 33rem;">
                                    <div class="card-header ">
                                        <div class="dropdown">
                                        {{$item->Title}}
                                        <button class="close" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a data-jstitle="{{$item->Title}}" data-jssubtitle="{{$item->Subtitle}}" data-jsmyurl="{{$item->MyUrl}}" data-jslogtime="{{$item->CreateTime}}"  class="dropdown-item " data-title="U" onclick="openForm('U')">{{ __('messages.update') }}</a></li>
                                            <li><a class="dropdown-item" onclick="opendelFrom()">{{ __('messages.delfrom') }}</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li >
                                            <iframe width="526" height="320" src="{{$item->MyUrl}}" frameborder="0" allowfullscreen></iframe>
                                        </li>
                                        <li class="list-group-item ">{{$item->Subtitle}}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $data->onEachSide(1)->links() }}
                    </div>
                </div>
                
                 <!-- 彈出新增表格 -->
                <div class="modal" id="formModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" id="formTitle" ></h4>
                                <!--button type="button" class="close" data-dismiss="modal">&times;</button -->
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- 在這裡放你的表格 -->
                                <form >
                                    <!-- 表格內容 -->
                                    <input type="hidden" id="memberid" value="{{ Auth::user()->MemberId }}">
                                    
                                    <div class="form-group">
                                        <label>{{ __('messages.title') }}</label>
                                        <input type="title" name="JsTitle" class="form-control" id="title" placeholder="{{ __('messages.title') }}"   required>
                                    </div>
                                    <!-- 更多表格欄位... -->
                                    <div class="form-group">
                                        <label >{{ __('messages.subtitle') }}</label>
                                        <input type="Subtitle"  name="JsSubtitle" class="form-control" id="subtitle" placeholder="{{ __('messages.subtitle') }}"    required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('messages.url') }}</label>
                                        <input type="MyUrl"  name="JsMyUrl" class="form-control" id="myUrl" placeholder="https://www.youtube.com/embed/+ youtube的 v="  required>
                                    </div>
                                        <input type="hidden" name="time" id="clientTime" value="">
                                        <input type="hidden" id="formAction" name="formAction">
                                        <input type="hidden" id="oldcreatetime" name="Jsoldtime" value="">
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <!-- 提交按鈕 -->
                                        <button type="submit" class="btn btn-primary" onclick="submitForm()">{{ __('messages.confirm') }}</button>
                                    </div>
                                </form>
                               
                            </div>

                        </div>
                    </div>
                </div>
                                            

                <!-- 彈出刪除表格 -->
                <div class="modal" id="delfrom">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">{{ __('messages.delfrom') }}</h4>
                                <!--button type="button" class="close" data-dismiss="modal">&times;</button -->
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- 在這裡放你的表格 -->
                                <form >
                                    <div class="form-group">
                                        <label>{{ __('messages.delfromQA') }}</label>
                                        <input type="hidden" id="createtime" value="{{ isset($item->CreateTime) ? $item->CreateTime : '' }}">
                                    </div>
                                </form>
                               
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer d-flex justify-content-between">
                                <!-- 提交按鈕 data-bs-dismiss 5版的-->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                <button type="submit" class="btn btn-primary" onclick="delForm()">{{ __('messages.confirm') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!--
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection