<?php /* Smarty version 2.6.26, created on 2013-06-20 18:56:36
         compiled from list.tpl */ ?>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<img src="<?php echo $this->_tpl_vars['item']['url']; ?>
" width="100"/>&nbsp;
<?php endforeach; endif; unset($_from); ?>