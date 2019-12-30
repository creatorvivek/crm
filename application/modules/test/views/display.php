<form action="<?= base_url() ?>test/save"  method="post" enctype="multipart/form-data">
	 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
<input type="file" name="userfile"> 
<input type="submit"  value="submit" name="importfile">

</form>