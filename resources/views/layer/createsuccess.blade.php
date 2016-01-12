@extends('app')

@section('content')
					<div class="alert alert-success" role="alert">
						Layer berhasil ditambahkan.lihat semua layer, klik <a href="<?php echo action('LayerController@viewAllLayer'); ?>" class="alert-link">disini</a>.
						untuk menambahakan layer lainnya, disini <a href="<?php echo action('LayerController@create'); ?>" class="alert-link">disini</a>.
					</div>
@stop