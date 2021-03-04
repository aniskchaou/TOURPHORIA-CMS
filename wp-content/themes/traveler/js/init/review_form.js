jQuery(document).ready(function($){$('.comment-form .add_rating li').hover(function(){var index=$(this).index();var sibling=$(this).siblings();sibling.removeClass('active');try
{index=parseInt(index);for(i=0;i<=index;i++)
{$(this).parent().find('li:eq('+i+')').addClass('active')}
$(this).parents('.form-group').find('.comment_rate').val(index+1)}catch(ex)
{console.log(ex)}})})