@extends('layouts.admin')

@section('title','Admin Setting')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
         <div class="alert alert-success mb-3 text-center">{{session('message')}}</div>
        @endif
        <form action="{{url('/admin/settings')}}" method="POST">
         @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">
                      {{__('customlang.website')}}
                    </h3>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">{{__('customlang.websiteName')}}</label>
                                <input type="text" name="website_name" value="{{$setting->website_name ?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">{{__('customlang.websiteURL')}}</label>
                                <input type="text" name="website_url" value="{{$setting->website_url?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{__('customlang.pageTitle')}}</label>
                                <input type="text" name="page_title" value="{{$setting->page_title?? ''}}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">{{__('customlang.metaKeyword')}}</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{$setting->meta_keyword?? ''}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">{{__('customlang.metaDescription')}}</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{$setting->meta_description?? ''}}</textarea>
                            </div>
                        </div>
                    </div>


            </div>

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                   <h3 class="text-white mb-0">{{__('customlang.website')}} - {{__('customlang.information')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>{{__('customlang.address')}}</label>
                            <textarea name="address" class="form-control" rows="3">{{$setting->address?? ''}}"</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{__('customlang.phone1')}}</label>
                            <input type="text" name="phone1" value="{{$setting->phone1?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{__('customlang.phone2')}}</label>
                            <input type="text" name="phone2" value="{{$setting->phone2?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{__('customlang.emailID1')}}</label>
                            <input type="text" name="email1" value="{{$setting->email1?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{__('customlang.emailID2')}}</label>
                            <input type="text" name="email2" value="{{$setting->email2?? ''}}" class="form-control">
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">{{__('customlang.website')}} - {{__('customlang.socialMedia')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Facebook (optional)</label>
                            <input type="text" name="facebook" value="{{$setting->facebook?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Twitter (optional)</label>
                            <input type="text" name="twitter" value="{{$setting->twitter?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Instagram (optional)</label>
                            <input type="text" name="instagram" value="{{$setting->instagram?? ''}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Youtube (optional)</label>
                            <input type="text" name="youtube" value="{{$setting->youtube?? ''}}" class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">{{__('customlang.website')}} - {{__('customlang.currency')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <select name="currency" class="form-select">
                                <option value="{{$setting->currency}}">{{__('customlang.selectCurrency')}}</option>
                                <option value="USD" {{$setting->currency=='USD' ? 'selected':''}}>USD</option>
                                <option value="EUR" {{$setting->currency=='EUR' ? 'selected':''}}>EUR</option>
                                <option value="SYP" {{$setting->currency=='SYP' ? 'selected':''}}>SYP</option>
                                <option value="SAR" {{$setting->currency=='SAR' ? 'selected':''}}>SAR</option>
                                <option value="AED" {{$setting->currency=='AED' ? 'selected':''}}>AED</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">{{__('customlang.saveSetting')}}</button>
            </div>
        </form>

    </div>
</div>

@endsection
