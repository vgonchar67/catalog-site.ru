<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>user name</th>
			<th>text</th>
			<th>homepage</th>
			<th>email</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($comments as $comment):?>
		<tr>
			<td><?=$comment['id']?></td>
			<td><?=$comment['user_name']?></td>
			<td><?=$comment['text']?></td>
			<td><?=$comment['homepage']?></td>
			<td><?=$comment['email']?></td>
			<td><a href="/admin/edit/<?=$comment['id']?>" class="btn btn-default">Редактировать</a></td>
			<td>
				<form action="admin/delete" method="post">
					<input type='hidden' name="id" value='<?=$comment['id']?>'>
					<input type="submit" class="btn btn-default" name="submit" value="Удалить">
				</form>
				
			</td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>

<?=$pagenationHTML?>