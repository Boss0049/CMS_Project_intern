@yield('header')
@section('cms')
	<template lang="html">
		<div class="container-fluid">
			@extends('layouts.app')
			<cms-test></cms-test>
		</div>
	</template>
@endsection

