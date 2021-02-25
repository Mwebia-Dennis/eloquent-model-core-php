<?php
	
	include 'Model.php';

	$model = new Model('posts');

	/*
	echo($model->where('$column', '$value')->orWhere('column1', 'value1', '>')->get());
	echo($model->where('$column', '%value%', 'like')->get());
	echo($model->orderBy('$column')->orderBy('column1', 'DESC')->orderBy('column1', 'DESC')->orderBy('column1', 'DESC')->orderBy('column1', 'DESC')->get());
	echo($model->select());
	$data = $model->select(['name'])->where('AREA', 'VDN')
				->limit(10)
				->offset(0)->orderBy('NAME')
				->get();
	var_dump($data);
	

	echo($model->update(['name' => 'sdfdsfsdf', 'dsfsd'=>'sdfsdfdsf'], 1, "customer_id"));
	echo($model->delete(1, "customer_id"));

	echo $model->save(array('name' => 'sdfdsfsdf', 'dsfsd'=>'sdfsdfdsf'));
	var_dump($model->all());
	var_dump($model->get());
	echo ($model->save(['title'=>'aaaaa', 'body' => 'dsfsdfqw21ddz\xqazqaz,lkokowmenxwcw']))?'boom':'failed';
	echo ($model->update(['title'=>'aaaaa', 'body' => 'sdfsdfsdf'], 8))?'boom':'failed';
	echo ($model->delete(5))?'deleted':'failed';

	var_dump($model->distinct(['title'])->get());
	var_dump($model->where('body', '%this%', 'like')->get());
	var_dump($model->reset()->select(['title'])->where('title', 'aaaaa')->get());
	var_dump($model->select(['title', 'created_at'])->where('title', 'aaaaa')->orderBy('created_at', 'DESC')->get());
	var_dump($model->select(['title', 'created_at'])->where('title', 'aaaaa')->orderBy('created_at', 'DESC')->limit(1)->offset(1)->get());
	echo($model->count());

	*/
	//var_dump($model->first());

?>