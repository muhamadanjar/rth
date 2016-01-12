@extends('app')

@section('content')

	<div class="alert alert-success" role="alert">
		Penanda letak berhasil diperbaruhi. Untuk Menambahkan penanda letak, klik <a href="{{ action('BookmarkController@createNewBookmark') }}" class="alert-link">disini</a>.
		Untuk mengatur penanda letak yang sudah ada, klik <a href="{{ action('BookmarkController@viewAllBookmark') }}" class="alert-link">disini</a> .
	</div>


	<div class="panel panel-default">
	    <div class="panel-heading"></div>
	    <div class="panel-body">             
	        <div class="row">
	            <div class="col-md-2"><a href="bookmark-new-bookmark"><button class="btn btn-sm btn-primary">Tambah</button></a></div>
	        </div>
	        <div class="row">
	            <div class="col-md-2">&nbsp;</div>
	        </div>
			<div class="row">
	            <div class="col-md-12">
	                <table class="table table-striped table-hover" id="datatable2">
	                    <thead>
	                        <tr>
	                            <th >#</th>
	                            <th>Bookmark</th>
	                            <th>WKID</th>
	                            <th>--</th>
	                           
	                        </tr>
	                    </thead>
	                    <tbody>
	                      
	                        @foreach ($bookmarks as $key => $value)
	                        <tr>
	                            <td><a href="bookmark/edit/{!! $value->id !!}">Edit</a> || <a href="bookmark/delete/{!! $value->id !!}">Hapus</a></td>
	                            <td> {{ $value->name }}</td>
	                            <td>{{ $value->wkid }}</td>
	                            <td></td>
	            
	                        </tr>
	                        @endforeach              
	                    </tbody>                  
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
@stop