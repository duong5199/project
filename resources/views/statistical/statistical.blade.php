@extends('layouts.default')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3 bg-warning">
				<span class="info-box-icon">
					<img src="dist/img/candidate.png">
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Đang làm việc</span>
					<span class="info-box-number">5,200</span>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3 bg-success">
				<span class="info-box-icon">
					<img src="dist/img/candidates.png">
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Đã nghỉ việc</span>
					<span class="info-box-number">92,050</span>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3 bg-danger">
				<span class="info-box-icon">
					<img src="dist/img/N.png">
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Nhân viên nam</span>
					<span class="info-box-number">114,381</span>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3 bg-info">
				<span class="info-box-icon">
					<img src="dist/img/Nu.png">
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Nhân viên nữ</span>
					<span class="info-box-number">163,921</span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection