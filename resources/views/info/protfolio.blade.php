@extends('layouts.app')

@section('protfolio')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>{{ __('messages.cards') }}<h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary" onclick="openForm()">新增</button>
                        </div>
                    </div>
                </div>

                 <!-- 彈出表格 -->
                <div class="modal" id="formModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">新增作品集</h4>
                                <!--button type="button" class="close" data-dismiss="modal">&times;</button -->
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- 在這裡放你的表格 -->
                                <form >
                                    <!-- 表格內容 -->
                                    <input type="hidden" id="memberid" value="{{ Auth::user()->MemberId }}">
                                    
                                    <div class="form-group">
                                        <label for="Title">標題名稱</label>
                                        <input type="title" class="form-control" id="title" placeholder="標題" required>
                                    </div>
                                    <!-- 更多表格欄位... -->
                                    <div class="form-group">
                                        <label for="Subtitle">副標題</label>
                                        <input type="Subtitle" class="form-control" id="subtitle" placeholder="副標題" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="MyUrl">網址</label>
                                        <input type="MyUrl" class="form-control" id="myUrl" placeholder="網址" required>
                                    </div>
                                        <input type="hidden" name="time" id="clientTime" value="">
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <!-- 提交按鈕 -->
                                        <button type="submit" class="btn btn-primary" onclick="submitForm()">提交</button>
                                    </div>
                                </form>
                               
                            </div>

                        </div>
                    </div>
                </div>

                
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection