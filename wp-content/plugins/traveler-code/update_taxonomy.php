<?php

function st_update_admin_menu()
{
    add_submenu_page( apply_filters('ot_theme_options_menu_slug','st_traveler_options'), "Update taxonomy", 'Update taxonomy', 'manage_options', 'update_taxonomy', 'st_control_update');
}
//add_action('admin_menu','st_update_admin_menu',50);

function st_control_update(){
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Update Taxonomy and Icons</h2><br><br>';


    echo '<div><a href="admin.php?page=update_taxonomy&add_before=true" class="button button-primary" >1 . Add Taxonomy before import XML </a></div><br>';
    echo '<div><a href="admin.php?page=update_taxonomy&add_after=true" class="button button-primary" >2 . Add Icons after import XML </a></div><br>';
    echo '<div><a href="admin.php?page=update_taxonomy&add_widget=true" class="button button-primary" >3 . Update Widget</a></div><br>';
    //echo '<div><a href="admin.php?page=update_taxonomy&add_option_tree=true" class="button button-primary" >4 . Update OptionTree</a></div><br>';

    if(!empty($_REQUEST['add_before']) and $_REQUEST['add_before'] == 'true'){
        st_update_taxonomy();
    }
    if(!empty($_REQUEST['add_after']) and $_REQUEST['add_after'] == 'true'){
        st_update_icon_import();
    }

    if(!empty($_REQUEST['add_widget']) and $_REQUEST['add_widget'] == 'true'){
        st_update_widget();
    }

    if(!empty($_REQUEST['add_option_tree']) and $_REQUEST['add_option_tree'] == 'true'){
        st_update_option_tree();
    }


}
function st_update_option_tree(){
    $data = '
YToxMDU6e3M6MTk6Imdlbl9lbmFibGVfc21zY3JvbGwiO3M6Mjoib24iO3M6NzoiZmF2aWNvbiI7czo4NToiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9mYXZpY29uLnBuZyI7czo0OiJsb2dvIjtzOjg0OiJodHRwOi8vc2hpbmV0aGVtZS5jb20vZGVtb3NkL3RyYXZlbGVyX2RlbW8vd3AtY29udGVudC91cGxvYWRzLzIwMTQvMTEvbG9nby13aGl0ZS5wbmciO3M6MTE6ImxvZ29fcmV0aW5hIjtzOjg1OiJodHRwOi8vc2hpbmV0aGVtZS5jb20vZGVtb3NkL3RyYXZlbGVyX2RlbW8vd3AtY29udGVudC90aGVtZXMvdHJhdmVsZXIvaW1nL2xvZ29AMngucG5nIjtzOjEyOiJzdF9zZW9fdGl0bGUiO3M6MDoiIjtzOjExOiJzdF9zZW9fZGVzYyI7czowOiIiO3M6MTU6InN0X3Nlb19rZXl3b3JkcyI7czowOiIiO3M6MTU6ImZvb3Rlcl90ZW1wbGF0ZSI7czowOiIiO3M6MjM6ImVuYWJsZV91c2VyX29ubGluZV9ub3RpIjtzOjI6Im9uIjtzOjI0OiJlbmFibGVfbGFzdF9ib29raW5nX25vdGkiO3M6Mjoib24iO3M6MTM6Im5vdGlfcG9zaXRpb24iO3M6ODoidG9wUmlnaHQiO3M6MTM6InJpZ2h0X3RvX2xlZnQiO3M6Mzoib2ZmIjtzOjEwOiJ0eXBvZ3JhcGh5IjtzOjA6IiI7czoxMjoiZ29vZ2xlX2ZvbnRzIjthOjE6e2k6MDthOjE6e3M6NjoiZmFtaWx5IjtzOjA6IiI7fX1zOjEwOiJzdGFyX2NvbG9yIjtzOjA6IiI7czoxMzoiaGVhZGluZ19mb250cyI7czowOiIiO3M6MTI6InN0eWxlX2xheW91dCI7czo0OiJ3aWRlIjtzOjE1OiJib2R5X2JhY2tncm91bmQiO3M6MDoiIjtzOjIwOiJtYWluX3dyYXBfYmFja2dyb3VuZCI7czowOiIiO3M6MjA6InN0eWxlX2RlZmF1bHRfc2NoZW1lIjtzOjA6IiI7czoxMDoibWFpbl9jb2xvciI7czo3OiIjZWQ4MzIzIjtzOjEwOiJjdXN0b21fY3NzIjtzOjA6IiI7czoxNjoic3RfdGV4dF9mZWF0dXJlZCI7czo4OiJGZWF0dXJlZCI7czoyMjoic3RfdGV4dF9mZWF0dXJlZF9jb2xvciI7czo0OiIjZmZmIjtzOjE5OiJzdF90ZXh0X2ZlYXR1cmVkX2JnIjtzOjc6IiMxOUExRTUiO3M6MTY6ImJsb2dfc2lkZWJhcl9wb3MiO3M6NToicmlnaHQiO3M6MTU6ImJsb2dfc2lkZWJhcl9pZCI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjI1OiJwYWdlX215X2FjY291bnRfZGFzaGJvYXJkIjtzOjM6IjYyNSI7czoyODoicGFnZV9yZWRpcmVjdF90b19hZnRlcl9sb2dpbiI7czozOiI2MjUiO3M6Mjk6InBhZ2VfcmVkaXJlY3RfdG9fYWZ0ZXJfbG9nb3V0IjtzOjE6IjUiO3M6MTU6InBhZ2VfdXNlcl9sb2dpbiI7czoyOiIzMiI7czoxMzoicGFnZV9jaGVja291dCI7czozOiI2NjgiO3M6MjA6InBhZ2VfcGF5bWVudF9zdWNjZXNzIjtzOjM6IjY3MCI7czoxODoicGFnZV9vcmRlcl9jb25maXJtIjtzOjQ6IjE3NDgiO3M6MjE6InBhZ2VfdGVybXNfY29uZGl0aW9ucyI7czo0OiIxNzEwIjtzOjEzOiJib29raW5nX21vZGFsIjtzOjM6Im9mZiI7czoyMjoiYm9va2luZ19lbmFibGVfY2FwdGNoYSI7czoyOiJvbiI7czoyMToiYm9va2luZ19jYXJkX2FjY2VwdGVkIjthOjU6e2k6MDthOjI6e3M6NToidGl0bGUiO3M6MTE6Ik1hc3RlciBDYXJkIjtzOjU6ImltYWdlIjtzOjkzOiJodHRwOi8vc2hpbmV0aGVtZS5jb20vZGVtb3NkL3RyYXZlbGVyX2RlbW8vd3AtY29udGVudC90aGVtZXMvdHJhdmVsZXIvaW1nL2NhcmQvbWFzdGVyY2FyZC5wbmciO31pOjE7YToyOntzOjU6InRpdGxlIjtzOjM6IkpDQiI7czo1OiJpbWFnZSI7czo4NjoiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9jYXJkL2pjYi5wbmciO31pOjI7YToyOntzOjU6InRpdGxlIjtzOjk6IlVuaW9uIFBheSI7czo1OiJpbWFnZSI7czo5MToiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9jYXJkL3VuaW9ucGF5LnBuZyI7fWk6MzthOjI6e3M6NToidGl0bGUiO3M6NDoiVklTQSI7czo1OiJpbWFnZSI7czo4NzoiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9jYXJkL3Zpc2EucG5nIjt9aTo0O2E6Mjp7czo1OiJ0aXRsZSI7czoxNjoiQW1lcmljYW4gRXhwcmVzcyI7czo1OiJpbWFnZSI7czo5ODoiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9jYXJkL2FtZXJpY2FuZXhwcmVzcy5wbmciO319czoxNjoiYm9va2luZ19jdXJyZW5jeSI7YTozOntpOjE7YTo0OntzOjU6InRpdGxlIjtzOjM6IlVTRCI7czo0OiJuYW1lIjtzOjM6IlVTRCI7czo2OiJzeW1ib2wiO3M6MToiJCI7czo0OiJyYXRlIjtzOjE6IjEiO31pOjA7YTo0OntzOjU6InRpdGxlIjtzOjM6IkVVUiI7czo0OiJuYW1lIjtzOjM6IkVVUiI7czo2OiJzeW1ib2wiO3M6Mzoi4oKsIjtzOjQ6InJhdGUiO3M6ODoiMC43OTY0OTEiO31pOjI7YTo0OntzOjU6InRpdGxlIjtzOjM6IkdCUCI7czo0OiJuYW1lIjtzOjM6IkFMTCI7czo2OiJzeW1ib2wiO3M6MjoiwqMiO3M6NDoicmF0ZSI7czo4OiIwLjYzNjE2OSI7fX1zOjI0OiJib29raW5nX3ByaW1hcnlfY3VycmVuY3kiO3M6MzoiVVNEIjtzOjIwOiJib29raW5nX2N1cnJlbmN5X3BvcyI7czo0OiJsZWZ0IjtzOjI2OiJib29raW5nX2N1cnJlbmN5X3ByZWNpc2lvbiI7czoxOiIyIjtzOjEyOiJwYXlwYWxfZW1haWwiO3M6MDoiIjtzOjIxOiJwYXlwYWxfZW5hYmxlX3NhbmRib3giO3M6Mjoib24iO3M6MTk6InBheXBhbF9hcGlfdXNlcm5hbWUiO3M6MDoiIjtzOjE5OiJwYXlwYWxfYXBpX3Bhc3N3b3JkIjtzOjA6IiI7czoyMDoicGF5cGFsX2FwaV9zaWduYXR1cmUiO3M6MDoiIjtzOjEwOiJ0YXhfZW5hYmxlIjtzOjM6Im9mZiI7czo5OiJ0YXhfdmFsdWUiO3M6MjoiMTAiO3M6MjA6ImhvdGVsX3Bvc3RzX3Blcl9wYWdlIjtzOjI6IjEyIjtzOjE5OiJob3RlbF9zaW5nbGVfbGF5b3V0IjtzOjA6IiI7czoxOToiaG90ZWxfc2VhcmNoX2xheW91dCI7czowOiIiO3M6MTU6ImhvdGVsX21heF9hZHVsdCI7czoyOiIxNCI7czoxNToiaG90ZWxfbWF4X2NoaWxkIjtzOjI6IjE0IjtzOjEyOiJob3RlbF9yZXZpZXciO3M6Mjoib24iO3M6MTg6ImhvdGVsX3Jldmlld19zdGF0cyI7YTo1OntpOjA7YToxOntzOjU6InRpdGxlIjtzOjU6IlNsZWVwIjt9aToxO2E6MTp7czo1OiJ0aXRsZSI7czo4OiJMb2NhdGlvbiI7fWk6MjthOjE6e3M6NToidGl0bGUiO3M6NzoiU2VydmljZSI7fWk6MzthOjE6e3M6NToidGl0bGUiO3M6OToiQ2xlYXJuZXNzIjt9aTo0O2E6MTp7czo1OiJ0aXRsZSI7czo1OiJSb29tcyI7fX1zOjE3OiJob3RlbF9zaWRlYmFyX3BvcyI7czo0OiJsZWZ0IjtzOjE4OiJob3RlbF9zaWRlYmFyX2FyZWEiO3M6MDoiIjtzOjI0OiJpc19mZWF0dXJlZF9zZWFyY2hfaG90ZWwiO3M6Mzoib2ZmIjtzOjE5OiJob3RlbF9zZWFyY2hfZmllbGRzIjthOjU6e2k6MDthOjQ6e3M6NToidGl0bGUiO3M6NToiV2hlcmUiO3M6NDoibmFtZSI7czo4OiJsb2NhdGlvbiI7czoxMDoibGF5b3V0X2NvbCI7czoxOiI0IjtzOjExOiJsYXlvdXQyX2NvbCI7czoxOiI0Ijt9aToxO2E6NDp7czo1OiJ0aXRsZSI7czo4OiJDaGVjayBpbiI7czo0OiJuYW1lIjtzOjc6ImNoZWNraW4iO3M6MTA6ImxheW91dF9jb2wiO3M6MToiMiI7czoxMToibGF5b3V0Ml9jb2wiO3M6MToiNCI7fWk6MjthOjQ6e3M6NToidGl0bGUiO3M6OToiQ2hlY2sgb3V0IjtzOjQ6Im5hbWUiO3M6ODoiY2hlY2tvdXQiO3M6MTA6ImxheW91dF9jb2wiO3M6MToiMiI7czoxMToibGF5b3V0Ml9jb2wiO3M6MToiNCI7fWk6MzthOjQ6e3M6NToidGl0bGUiO3M6NToiUm9vbXMiO3M6NDoibmFtZSI7czo4OiJyb29tX251bSI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIyIjtzOjExOiJsYXlvdXQyX2NvbCI7czoxOiI0Ijt9aTo0O2E6NDp7czo1OiJ0aXRsZSI7czo1OiJBZHVsdCI7czo0OiJuYW1lIjtzOjU6ImFkdWx0IjtzOjEwOiJsYXlvdXRfY29sIjtzOjE6IjIiO3M6MTE6ImxheW91dDJfY29sIjtzOjE6IjQiO319czoyNjoiaG90ZWxfYWxsb3dfc2VhcmNoX2FkdmFuY2UiO3M6Mzoib2ZmIjtzOjE4OiJob3RlbF9uZWFyYnlfcmFuZ2UiO3M6MjoiMTAiO3M6MjA6InJlbnRhbF9zaW5nbGVfbGF5b3V0IjtzOjA6IiI7czoyMDoicmVudGFsX3NlYXJjaF9sYXlvdXQiO3M6MDoiIjtzOjEzOiJyZW50YWxfcmV2aWV3IjtzOjI6Im9uIjtzOjE5OiJyZW50YWxfcmV2aWV3X3N0YXRzIjthOjU6e2k6MDthOjE6e3M6NToidGl0bGUiO3M6NToiU2xlZXAiO31pOjE7YToxOntzOjU6InRpdGxlIjtzOjg6IkxvY2F0aW9uIjt9aToyO2E6MTp7czo1OiJ0aXRsZSI7czo3OiJTZXJ2aWNlIjt9aTozO2E6MTp7czo1OiJ0aXRsZSI7czo5OiJDbGVhcm5lc3MiO31pOjQ7YToxOntzOjU6InRpdGxlIjtzOjU6IlJvb21zIjt9fXM6MTg6InJlbnRhbF9zaWRlYmFyX3BvcyI7czo0OiJsZWZ0IjtzOjE5OiJyZW50YWxfc2lkZWJhcl9hcmVhIjtzOjE0OiJyZW50YWwtc2lkZWJhciI7czoyNToiaXNfZmVhdHVyZWRfc2VhcmNoX3JlbnRhbCI7czozOiJvZmYiO3M6MjA6InJlbnRhbF9zZWFyY2hfZmllbGRzIjthOjU6e2k6NjthOjQ6e3M6NToidGl0bGUiO3M6MjI6IkZpbmQgWW91ciBQZXJmZWN0IEhvbWUiO3M6NDoibmFtZSI7czo4OiJsb2NhdGlvbiI7czoxMDoibGF5b3V0X2NvbCI7czoyOiIxMiI7czoxMToibGF5b3V0X2NvbDIiO3M6MjoiMTIiO31pOjU7YTo0OntzOjU6InRpdGxlIjtzOjg6IkNoZWNrLWluIjtzOjQ6Im5hbWUiO3M6NzoiY2hlY2tpbiI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIzIjtzOjExOiJsYXlvdXRfY29sMiI7czoxOiIzIjt9aTo3O2E6NDp7czo1OiJ0aXRsZSI7czo5OiJDaGVjay1vdXQiO3M6NDoibmFtZSI7czo4OiJjaGVja291dCI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIzIjtzOjExOiJsYXlvdXRfY29sMiI7czoxOiIzIjt9aTo4O2E6NDp7czo1OiJ0aXRsZSI7czo1OiJSb29tcyI7czo0OiJuYW1lIjtzOjg6InJvb21fbnVtIjtzOjEwOiJsYXlvdXRfY29sIjtzOjE6IjMiO3M6MTE6ImxheW91dF9jb2wyIjtzOjE6IjMiO31pOjQ7YTo0OntzOjU6InRpdGxlIjtzOjY6IkFkdWx0cyI7czo0OiJuYW1lIjtzOjU6ImFkdWx0IjtzOjEwOiJsYXlvdXRfY29sIjtzOjE6IjIiO3M6MTE6ImxheW91dF9jb2wyIjtzOjE6IjMiO319czoxODoiY2Fyc19zaW5nbGVfbGF5b3V0IjtzOjM6IjY3OCI7czoxODoiY2Fyc19sYXlvdXRfbGF5b3V0IjtzOjM6Ijg5MCI7czoxNToiY2Fyc19wcmljZV91bml0IjtzOjM6ImRheSI7czoyMjoiaXNfZmVhdHVyZWRfc2VhcmNoX2NhciI7czozOiJvZmYiO3M6MTc6ImNhcl9zZWFyY2hfZmllbGRzIjthOjQ6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6MTI6IlBpY2stdXAtRnJvbSI7czoxNzoibGF5b3V0X2NvbF9ub3JtYWwiO3M6MToiNiI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjEyOiJwaWNrLXVwLWZvcm0iO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjExOiJEcm9wLW9mZiBUbyI7czoxNzoibGF5b3V0X2NvbF9ub3JtYWwiO3M6MToiNiI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjExOiJkcm9wLW9mZi10byI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6MjY6IlBpY2stdXAgRGF0ZSAsUGljay11cCBUaW1lIjtzOjE3OiJsYXlvdXRfY29sX25vcm1hbCI7czoxOiI2IjtzOjE1OiJmaWVsZF9hdHJyaWJ1dGUiO3M6MTc6InBpY2stdXAtZGF0ZS10aW1lIjt9aTozO2E6Mzp7czo1OiJ0aXRsZSI7czoyODoiRHJvcC1vZmYgRGF0ZSAsRHJvcC1vZmYgVGltZSI7czoxNzoibGF5b3V0X2NvbF9ub3JtYWwiO3M6MToiNiI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjE4OiJkcm9wLW9mZi1kYXRlLXRpbWUiO319czoyMToiY2FyX3NlYXJjaF9maWVsZHNfYm94IjthOjY6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6MTI6IlBpY2stdXAgRnJvbSI7czoxNDoibGF5b3V0X2NvbF9ib3giO3M6MToiNiI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjEyOiJwaWNrLXVwLWZvcm0iO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjExOiJEcm9wLW9mZiBUbyI7czoxNDoibGF5b3V0X2NvbF9ib3giO3M6MToiNiI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjExOiJkcm9wLW9mZi10byI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6MTI6IlBpY2stdXAgRGF0ZSI7czoxNDoibGF5b3V0X2NvbF9ib3giO3M6MToiMyI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjEyOiJwaWNrLXVwLWRhdGUiO31pOjM7YTozOntzOjU6InRpdGxlIjtzOjEyOiJQaWNrLXVwIFRpbWUiO3M6MTQ6ImxheW91dF9jb2xfYm94IjtzOjE6IjMiO3M6MTU6ImZpZWxkX2F0cnJpYnV0ZSI7czoxMjoicGljay11cC10aW1lIjt9aTo0O2E6Mzp7czo1OiJ0aXRsZSI7czoxMzoiRHJvcC1vZmYgRGF0ZSI7czoxNDoibGF5b3V0X2NvbF9ib3giO3M6MToiMyI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjEzOiJkcm9wLW9mZi1kYXRlIjt9aTo1O2E6Mzp7czo1OiJ0aXRsZSI7czoxMzoiRHJvcC1vZmYgVGltZSI7czoxNDoibGF5b3V0X2NvbF9ib3giO3M6MToiMyI7czoxNToiZmllbGRfYXRycmlidXRlIjtzOjEzOiJkcm9wLW9mZi10aW1lIjt9fXM6MjA6ImFjdGl2aXR5X3RvdXJfcmV2aWV3IjtzOjI6Im9uIjtzOjEyOiJ0b3Vyc19sYXlvdXQiO3M6NDoiMTExNCI7czoxOToidG91cnNfc2VhcmNoX2xheW91dCI7czo0OiIxMTE1IjtzOjE4OiJ0b3Vyc19zaW1pbGFyX3RvdXIiO3M6MToiMyI7czoyMzoiaXNfZmVhdHVyZWRfc2VhcmNoX3RvdXIiO3M6Mjoib24iO3M6Mjc6ImFjdGl2aXR5X3RvdXJfc2VhcmNoX2ZpZWxkcyI7YTozOntpOjA7YTo0OntzOjU6InRpdGxlIjtzOjc6IkFkZHJlc3MiO3M6MTA6ImxheW91dF9jb2wiO3M6MToiNiI7czoxMToibGF5b3V0Ml9jb2wiO3M6MToiNiI7czoxODoidG91cnNfZmllbGRfc2VhcmNoIjtzOjc6ImFkZHJlc3MiO31pOjE7YTo0OntzOjU6InRpdGxlIjtzOjE0OiJEZXBhcnR1cmUgZGF0ZSI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIzIjtzOjExOiJsYXlvdXQyX2NvbCI7czoxOiIzIjtzOjE4OiJ0b3Vyc19maWVsZF9zZWFyY2giO3M6ODoiY2hlY2tfaW4iO31pOjI7YTo0OntzOjU6InRpdGxlIjtzOjExOiJBcnJpdmUgZGF0ZSI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIzIjtzOjExOiJsYXlvdXQyX2NvbCI7czoxOiIzIjtzOjE4OiJ0b3Vyc19maWVsZF9zZWFyY2giO3M6OToiY2hlY2tfb3V0Ijt9fXM6MTU6ImFjdGl2aXR5X3JldmlldyI7czoyOiJvbiI7czoxNToiYWN0aXZpdHlfbGF5b3V0IjtzOjQ6IjE0NjkiO3M6MjI6ImFjdGl2aXR5X3NlYXJjaF9sYXlvdXQiO3M6NDoiMTQ5MCI7czoyNzoiaXNfZmVhdHVyZWRfc2VhcmNoX2FjdGl2aXR5IjtzOjM6Im9mZiI7czoyMjoiYWN0aXZpdHlfc2VhcmNoX2ZpZWxkcyI7YTozOntpOjA7YTo0OntzOjU6InRpdGxlIjtzOjc6IkFkZHJlc3MiO3M6MTA6ImxheW91dF9jb2wiO3M6MToiMyI7czoxMToibGF5b3V0Ml9jb2wiO3M6MToiNiI7czoyMToiYWN0aXZpdHlfZmllbGRfc2VhcmNoIjtzOjc6ImFkZHJlc3MiO31pOjE7YTo0OntzOjU6InRpdGxlIjtzOjQ6IkZyb20iO3M6MTA6ImxheW91dF9jb2wiO3M6MToiMyI7czoxMToibGF5b3V0Ml9jb2wiO3M6MToiMyI7czoyMToiYWN0aXZpdHlfZmllbGRfc2VhcmNoIjtzOjg6ImNoZWNrX2luIjt9aToyO2E6NDp7czo1OiJ0aXRsZSI7czoyOiJUbyI7czoxMDoibGF5b3V0X2NvbCI7czoxOiIzIjtzOjExOiJsYXlvdXQyX2NvbCI7czoxOiIzIjtzOjIxOiJhY3Rpdml0eV9maWVsZF9zZWFyY2giO3M6OToiY2hlY2tfb3V0Ijt9fXM6MjI6InBhcnRuZXJfZW5hYmxlX2ZlYXR1cmUiO3M6Mjoib24iO3M6MjE6InBhcnRuZXJfcG9zdF9ieV9hZG1pbiI7czoyOiJvbiI7czoyMToic2VhcmNoX2VuYWJsZV9wcmVsb2FkIjtzOjI6Im9uIjtzOjIwOiJzZWFyY2hfcHJlbG9hZF9pbWFnZSI7czoxMTg6Imh0dHA6Ly9zaGluZXRoZW1lLmNvbS9kZW1vc2QvdHJhdmVsZXJfZGVtby93cC1jb250ZW50L3VwbG9hZHMvMjAxNC8xMS91cHBlcl9sYWtlX2luX25ld195b3JrX2NlbnRyYWxfcGFya18xMDI0eDQ4Ny5qcGciO3M6MTk6InNlYXJjaF9yZXN1bHRzX3ZpZXciO3M6NDoibGlzdCI7czoxMToic2VhcmNoX3RhYnMiO2E6NTp7aTowO2E6NTp7czo1OiJ0aXRsZSI7czo2OiJIb3RlbHMiO3M6OToiY2hlY2tfdGFiIjtzOjI6Im9uIjtzOjg6InRhYl9pY29uIjtzOjEzOiJmYS1idWlsZGluZy1vIjtzOjE2OiJ0YWJfc2VhcmNoX3RpdGxlIjtzOjI1OiJTZWFyY2ggYW5kIFNhdmUgb24gSG90ZWxzIjtzOjg6InRhYl9uYW1lIjtzOjU6ImhvdGVsIjt9aToxO2E6NTp7czo1OiJ0aXRsZSI7czo0OiJDYXJzIjtzOjk6ImNoZWNrX3RhYiI7czoyOiJvbiI7czo4OiJ0YWJfaWNvbiI7czo2OiJmYS1jYXIiO3M6MTY6InRhYl9zZWFyY2hfdGl0bGUiO3M6Mjg6IlNlYXJjaCBmb3IgQ2hlYXAgUmVudGFsIENhcnMiO3M6ODoidGFiX25hbWUiO3M6NDoiY2FycyI7fWk6MjthOjQ6e3M6NToidGl0bGUiO3M6NToiVG91cnMiO3M6ODoidGFiX2ljb24iO3M6OToiZmEtZmxhZy1vIjtzOjE2OiJ0YWJfc2VhcmNoX3RpdGxlIjtzOjU6IlRvdXJzIjtzOjg6InRhYl9uYW1lIjtzOjQ6InRvdXIiO31pOjM7YTo0OntzOjU6InRpdGxlIjtzOjc6IlJlbnRhbHMiO3M6ODoidGFiX2ljb24iO3M6NzoiZmEtaG9tZSI7czoxNjoidGFiX3NlYXJjaF90aXRsZSI7czo3OiJSZW50YWxzIjtzOjg6InRhYl9uYW1lIjtzOjY6InJlbnRhbCI7fWk6NDthOjQ6e3M6NToidGl0bGUiO3M6MTA6IkFjdGl2aXRpZXMiO3M6ODoidGFiX2ljb24iO3M6NzoiZmEtYm9sdCI7czoxNjoidGFiX3NlYXJjaF90aXRsZSI7czoyNjoiRmluZCBZb3VyIFBlcmZlY3QgQWN0aXZpdHkiO3M6ODoidGFiX25hbWUiO3M6MTA6ImFjdGl2aXRpZXMiO319czoxMDoiZW1haWxfZnJvbSI7czoxOToiVHJhdmVsZXIgU2hpbmV0aGVtZSI7czoxODoiZW1haWxfZnJvbV9hZGRyZXNzIjtzOjIzOiJ0cmF2ZWxlckBzaGluZXRoZW1lLmNvbSI7czoxMDoiZW1haWxfbG9nbyI7czo4MjoiaHR0cDovL3NoaW5ldGhlbWUuY29tL2RlbW9zZC90cmF2ZWxlcl9kZW1vL3dwLWNvbnRlbnQvdGhlbWVzL3RyYXZlbGVyL2ltZy9sb2dvLnBuZyI7czoxNToic29jaWFsX2ZiX2xvZ2luIjtzOjI6Im9uIjtzOjE1OiJzb2NpYWxfZ2dfbG9naW4iO3M6Mjoib24iO3M6MTU6InNvY2lhbF90d19sb2dpbiI7czoyOiJvbiI7czo2OiI0MDRfYmciO3M6NzM6Imh0dHA6Ly90cmF2ZWxlcmRhdGEud3BlbmdpbmUuY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE0LzExLzIwMDB4MTMwMC5naWYiO3M6ODoiNDA0X3RleHQiO3M6MDoiIjtzOjE3OiJhZHZfY29tcHJlc3NfaHRtbCI7czozOiJvZmYiO3M6MjM6ImFkdl9iZWZvcmVfYm9keV9jb250ZW50IjtzOjA6IiI7czoyMDoiZWR2X2VuYWJsZV9kZW1vX21vZGUiO3M6Mzoib2ZmIjtzOjE0OiJlZHZfc2hhcmVfY29kZSI7czoxMTk2OiI8bGk+PGEgaHJlZj0iaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3NoYXJlci9zaGFyZXIucGhwP3U9W19fcG9zdF9wZXJtYWxpbmtfX10mYW1wO3RpdGxlPVtfX3Bvc3RfdGl0bGVfX10iIHRhcmdldD0iX2JsYW5rIiBvcmlnaW5hbC10aXRsZT0iRmFjZWJvb2siPjxpIGNsYXNzPSJmYSBmYS1mYWNlYm9vayBmYS1sZyI+PC9pPjwvYT48L2xpPg0KICAgICAgICA8bGk+PGEgaHJlZj0iaHR0cDovL3R3aXR0ZXIuY29tL3NoYXJlP3VybD1bX19wb3N0X3Blcm1hbGlua19fXSZhbXA7dGl0bGU9W19fcG9zdF90aXRsZV9fXSIgdGFyZ2V0PSJfYmxhbmsiIG9yaWdpbmFsLXRpdGxlPSJUd2l0dGVyIj48aSBjbGFzcz0iZmEgZmEtdHdpdHRlciBmYS1sZyI+PC9pPjwvYT48L2xpPg0KICAgICAgICA8bGk+PGEgaHJlZj0iaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20vc2hhcmU/dXJsPVtfX3Bvc3RfcGVybWFsaW5rX19dJmFtcDt0aXRsZT1bX19wb3N0X3RpdGxlX19dIiB0YXJnZXQ9Il9ibGFuayIgb3JpZ2luYWwtdGl0bGU9Ikdvb2dsZSsiPjxpIGNsYXNzPSJmYSBmYS1nb29nbGUtcGx1cyBmYS1sZyI+PC9pPjwvYT48L2xpPg0KICAgICAgICA8bGk+PGEgY2xhc3M9Im5vLW9wZW4iIGhyZWY9ImphdmFzY3JpcHQ6dm9pZCgoZnVuY3Rpb24oKSU3QnZhciUyMGU9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnc2NyaXB0Jyk7ZS5zZXRBdHRyaWJ1dGUoJ3R5cGUnLCd0ZXh0L2phdmFzY3JpcHQnKTtlLnNldEF0dHJpYnV0ZSgnY2hhcnNldCcsJ1VURi04Jyk7ZS5zZXRBdHRyaWJ1dGUoJ3NyYycsJ2h0dHA6Ly9hc3NldHMucGludGVyZXN0LmNvbS9qcy9waW5tYXJrbGV0LmpzP3I9JytNYXRoLnJhbmRvbSgpKjk5OTk5OTk5KTtkb2N1bWVudC5ib2R5LmFwcGVuZENoaWxkKGUpJTdEKSgpKTsiIHRhcmdldD0iX2JsYW5rIiBvcmlnaW5hbC10aXRsZT0iUGludGVyZXN0Ij48aSBjbGFzcz0iZmEgZmEtcGludGVyZXN0IGZhLWxnIj48L2k+PC9hPjwvbGk+DQogICAgICAgIDxsaT48YSBocmVmPSJodHRwOi8vd3d3LmxpbmtlZGluLmNvbS9zaGFyZUFydGljbGU/bWluaT10cnVlJmFtcDt1cmw9W19fcG9zdF9wZXJtYWxpbmtfX10mYW1wO3RpdGxlPVtfX3Bvc3RfdGl0bGVfX10iIHRhcmdldD0iX2JsYW5rIiBvcmlnaW5hbC10aXRsZT0iTGlua2VkSW4iPjxpIGNsYXNzPSJmYSBmYS1saW5rZWRpbiBmYS1sZyI+PC9pPjwvYT48L2xpPiI7fQ==';
    $options=unserialize(ot_decode($data));
    update_option( ot_options_id(), $options );
    _e('Update OptionTree -> OK',STP_TEXTDOMAIN);
}
function st_update_taxonomy(){
    /*$attr = 'a:8:{s:16:"hotel_facilities";a:3:{s:4:"name";s:16:"Hotel Facilities";s:9:"post_type";a:1:{i:0;s:8:"st_hotel";}s:12:"hierarchical";i:1;}s:15:"room_facilities";a:3:{s:4:"name";s:15:"Room facilities";s:9:"post_type";a:1:{i:0;s:10:"hotel_room";}s:12:"hierarchical";i:1;}s:12:"car_features";a:3:{s:4:"name";s:12:"Car Features";s:9:"post_type";a:1:{i:0;s:7:"st_cars";}s:12:"hierarchical";i:1;}s:17:"default_equipment";a:3:{s:4:"name";s:17:"Default Equipment";s:9:"post_type";a:1:{i:0;s:7:"st_cars";}s:12:"hierarchical";i:1;}s:11:"hotel_theme";a:3:{s:4:"name";s:11:"Hotel Theme";s:9:"post_type";a:1:{i:0;s:8:"st_hotel";}s:12:"hierarchical";i:1;}s:9:"amenities";a:3:{s:4:"name";s:9:"Amenities";s:9:"post_type";a:1:{i:0;s:9:"st_rental";}s:12:"hierarchical";i:1;}s:11:"suitability";a:3:{s:4:"name";s:11:"Suitability";s:9:"post_type";a:1:{i:0;s:9:"st_rental";}s:12:"hierarchical";i:1;}s:11:"attractions";a:3:{s:4:"name";s:11:"Attractions";s:9:"post_type";a:1:{i:0;s:11:"st_activity";}s:12:"hierarchical";i:1;}}';*/
    $attr = 'a:10:{s:16:"hotel_facilities";a:3:{s:4:"name";s:16:"Hotel Facilities";s:9:"post_type";a:1:{i:0;s:8:"st_hotel";}s:12:"hierarchical";i:1;}s:15:"room_facilities";a:3:{s:4:"name";s:15:"Room facilities";s:9:"post_type";a:1:{i:0;s:10:"hotel_room";}s:12:"hierarchical";i:1;}s:12:"car_features";a:3:{s:4:"name";s:12:"Car Features";s:9:"post_type";a:1:{i:0;s:7:"st_cars";}s:12:"hierarchical";i:1;}s:17:"default_equipment";a:3:{s:4:"name";s:17:"Default Equipment";s:9:"post_type";a:1:{i:0;s:7:"st_cars";}s:12:"hierarchical";i:1;}s:11:"hotel_theme";a:3:{s:4:"name";s:11:"Hotel Theme";s:9:"post_type";a:1:{i:0;s:8:"st_hotel";}s:12:"hierarchical";i:1;}s:9:"amenities";a:3:{s:4:"name";s:9:"Amenities";s:9:"post_type";a:1:{i:0;s:9:"st_rental";}s:12:"hierarchical";i:1;}s:11:"suitability";a:3:{s:4:"name";s:11:"Suitability";s:9:"post_type";a:1:{i:0;s:9:"st_rental";}s:12:"hierarchical";i:1;}s:11:"attractions";a:3:{s:4:"name";s:11:"Attractions";s:9:"post_type";a:1:{i:0;s:11:"st_activity";}s:12:"hierarchical";i:1;}s:9:"durations";a:3:{s:4:"name";s:9:"Durations";s:9:"post_type";a:1:{i:0;s:8:"st_tours";}s:12:"hierarchical";i:1;}s:9:"languages";a:3:{s:4:"name";s:9:"Languages";s:9:"post_type";a:1:{i:0;s:8:"st_tours";}s:12:"hierarchical";i:1;}}';
    $attr = unserialize($attr);
    update_option( 'st_attribute_taxonomy', $attr );
    _e('Add Taxonomy before import XML -> OK',STP_TEXTDOMAIN);
}
function st_update_widget(){
    $data_widget = '{"blog-sidebar":{"search-2":{"title":""},"categories-2":{"title":"Categories","count":0,"hierarchical":0,"dropdown":0},"st_widget_list_post-2":{"title":"Popular Posts","number":5,"show_date":true,"orderby":"views_count","order":"DESC"},"recent-comments-2":{"title":"Recent Comments","number":5},"sttwitterwidget-2":{"user_id":"evanto","title":"Twitter Feed","number_tweet":"5"},"st_widget_list_gallery-2":{"title":"Gallery","number":9}},"page-sidebar":{"st_nav_menu-2":{"nav_menu":56,"title":false}},"hotel-sidebar":{"st_widget_search_hotel-2":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"1\",\"title\":\"Star Rating\",\"field\":\"hotel_rate\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"2\",\"title\":\"Review Score\",\"field\":\"rate\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"3\",\"title\":\"Hotel Theme\",\"field\":\"taxonomy\",\"taxonomy\":\"hotel_facilities\"}]","style":"dark"}},"hotel-sidebar-2":{"st_widget_search_hotel-3":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"0\",\"title\":\"Star Review\",\"field\":\"rate\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"0\",\"title\":\"Facility\",\"field\":\"taxonomy\",\"taxonomy\":\"hotel_facilities\"},{\"order\":\"0\",\"title\":\"Hotel Theme\",\"field\":\"taxonomy\",\"taxonomy\":\"hotel_theme\"}]","style":"light"}},"cars-sidebar":{"st_widget_search_cars-2":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Car Feature\",\"field\":\"taxonomy\",\"taxonomy\":\"car_features\"},{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"car_features\"},{\"order\":\"0\",\"title\":\"Default Equipment\",\"field\":\"taxonomy\",\"taxonomy\":\"default_equipment\"},{\"order\":\"0\",\"title\":\"Category Car\",\"field\":\"taxonomy\",\"taxonomy\":\"st_category_cars\"},{\"order\":\"0\",\"title\":\"Pickup Features\",\"field\":\"taxonomy\",\"taxonomy\":\"st_cars_pickup_features\"}]","st_style":"dark"}},"cars-sidebar-2":{"st_widget_search_cars-3":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Car Feature\",\"field\":\"taxonomy\",\"taxonomy\":\"car_features\"},{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"car_features\"},{\"order\":\"0\",\"title\":\"Default Equipment\",\"field\":\"taxonomy\",\"taxonomy\":\"default_equipment\"},{\"order\":\"0\",\"title\":\"Category Car\",\"field\":\"taxonomy\",\"taxonomy\":\"st_category_cars\"},{\"order\":\"0\",\"title\":\"Pickup Features\",\"field\":\"taxonomy\",\"taxonomy\":\"st_cars_pickup_features\"}]","st_style":"light"}},"rental-sidebar":{"st_widget_search_rental-2":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"\",\"field\":\"price\",\"taxonomy\":\"amenities\"},{\"order\":\"1\",\"title\":\"Score Rating\",\"field\":\"rate\",\"taxonomy\":\"amenities\"},{\"order\":\"2\",\"title\":\"Suitability\",\"field\":\"taxonomy\",\"taxonomy\":\"suitability\"},{\"order\":\"3\",\"title\":\"Amenities\",\"field\":\"taxonomy\",\"taxonomy\":\"amenities\"}]","style":"dark"}},"rental-sidebar-2":{"st_widget_search_rental-3":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price:\",\"field\":\"price\",\"taxonomy\":\"amenities\"},{\"order\":\"1\",\"title\":\"Score Rating\",\"field\":\"rate\",\"taxonomy\":\"amenities\"},{\"order\":\"2\",\"title\":\"Amenities\",\"field\":\"taxonomy\",\"taxonomy\":\"amenities\"},{\"order\":\"3\",\"title\":\"Suitability\",\"field\":\"taxonomy\",\"taxonomy\":\"suitability\"}]","style":"light"}},"activity-sidebar":{"st_widget_search_activity-2":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"attractions\"},{\"order\":\"1\",\"title\":\"Review Score\",\"field\":\"rate\",\"taxonomy\":\"attractions\"},{\"order\":\"2\",\"title\":\"Attractions\",\"field\":\"taxonomy\",\"taxonomy\":\"attractions\"}]","st_style":"dark"}},"activity-sidebar-2":{"st_widget_search_activity-3":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"attractions\"},{\"order\":\"1\",\"title\":\"Category\",\"field\":\"taxonomy\",\"taxonomy\":\"attractions\"}]","st_style":"light"}},"tours-sidebar":{"st_widget_search_tour-2":{"title":"Filter By:","show_attribute":"","st_search_fields":"[{\"order\":\"0\",\"title\":\"Price\",\"field\":\"price\",\"taxonomy\":\"st_tour_type\"},{\"order\":\"1\",\"title\":\"Review Score\",\"field\":\"rate\",\"taxonomy\":\"st_tour_type\"},{\"order\":\"2\",\"title\":\"Category\",\"field\":\"taxonomy\",\"taxonomy\":\"st_tour_type\"}]"}},"tour-single-sidebar":{"calendar-2":{"title":""}}}';
    $data_object=json_decode($data_widget);
    wie_import_data( $data_object );
    _e('Update widget -> OK',STP_TEXTDOMAIN);
}
function st_update_icon_import(){
    $list_icon = 'a:68:{s:19:"2-pieces-of-laggage";s:12:"fa-briefcase";s:7:"3-doors";s:12:"im-car-doors";s:16:"air-conditioning";s:6:"im-air";s:17:"airport-transport";s:8:"im-plane";s:8:"amusemen";s:0:"";s:22:"automatic-transmission";s:13:"im-shift-auto";s:7:"bathtub";s:13:"im im-bathtub";s:10:"city-trips";s:0:"";s:15:"climate-control";s:18:"im-climate-control";s:3:"suv";s:0:"";s:8:"cultural";s:0:"";s:6:"deluxe";s:0:"";s:10:"ecotourism";s:0:"";s:12:"elder-access";s:8:"im-elder";s:13:"escorted-tour";s:0:"";s:12:"family-suite";s:0:"";s:14:"fitness-center";s:10:"im-fitness";s:14:"flat-screen-tv";s:8:"im im-tv";s:8:"fm-radio";s:5:"im-fm";s:12:"for-children";s:11:"im-children";s:11:"gas-vehicle";s:9:"im-diesel";s:10:"group-tour";s:0:"";s:12:"hosted-tours";s:0:"";s:13:"im-im-terrace";s:13:"im im-terrace";s:7:"kitchen";s:10:"im-kitchen";s:9:"landmarks";s:0:"";s:6:"ligula";s:0:"";s:6:"luxury";s:0:"";s:9:"main-menu";s:0:"";s:11:"main-menu-2";s:0:"";s:14:"meet-and-greet";s:9:"im-driver";s:24:"menu-sidebar-custom-page";s:0:"";s:8:"mini-bar";s:9:"im im-bar";s:7:"museums";s:0:"";s:6:"normal";s:0:"";s:8:"outdoors";s:0:"";s:7:"parking";s:10:"im-parking";s:5:"party";s:0:"";s:5:"patio";s:11:"im im-patio";s:4:"attr";s:0:"";s:11:"pet-allowed";s:6:"im-dog";s:4:"pool";s:7:"im-pool";s:17:"post-format-audio";s:0:"";s:19:"post-format-gallery";s:0:"";s:17:"post-format-image";s:0:"";s:16:"post-format-link";s:0:"";s:17:"post-format-quote";s:0:"";s:17:"post-format-video";s:0:"";s:16:"power-door-locks";s:7:"im-lock";s:13:"power-windows";s:13:"im-car-window";s:7:"economy";s:0:"";s:10:"queen-room";s:0:"";s:10:"restaurant";s:13:"im-restaurant";s:19:"shuttle-bus-service";s:6:"im-bus";s:15:"smoking-allowed";s:10:"im-smoking";s:10:"soundproof";s:16:"im im-soundproof";s:3:"spa";s:6:"im-spa";s:6:"sports";s:0:"";s:8:"standard";s:0:"";s:27:"standard-double-double-room";s:0:"";s:13:"standard-room";s:0:"";s:12:"stereo-cdmp3";s:9:"im-stereo";s:15:"terminal-pickup";s:8:"fa-plane";s:13:"uncategorized";s:0:"";s:18:"up-to-4-passengers";s:7:"fa-male";s:17:"wheelchair-access";s:14:"im-wheel-chair";s:14:"wi-fi-internet";s:8:"im-wi-fi";s:14:"zoos-aquariums";s:0:"";}';
    $list_icon = unserialize($list_icon);
    $taxonomies = get_taxonomies();
    $list_term = get_terms($taxonomies);
    foreach($list_term as $k=>$v){
        foreach($list_icon as $key => $value){
            if($v->slug == $key){
                if(!empty($value)){
                    update_option('tax_meta_'.$v->term_id,array('st_icon'=>$value));
                }
            }
        }
    }
    _e('Add Taxonomy after import XML -> OK',STP_TEXTDOMAIN);
}


/**
 * Import widget JSON data
 *
 * @since 0.4
 * @global array $wp_registered_sidebars
 * @param object $data JSON widget data from .wie file
 * @return array Results array
 */
if(!function_exists('remove_all_widgets_from_sidebar'))
{
    function remove_all_widgets_from_sidebar($sidebar_id)
    {
        $old_sidebar=get_option('sidebars_widgets',array());
        if(isset($old_sidebar[$sidebar_id]))
        {
            $old_sidebar[$sidebar_id]=array();
        }

        update_option('sidebars_widgets',$old_sidebar);
    }
}
if(!function_exists('wie_import_data'))
{
    function wie_import_data( $data ) {
        global $wp_registered_sidebars;
        // Have valid data?
        // If no data or could not decode
        if ( empty( $data ) || ! is_object( $data ) ) {
            wp_die(
                __( 'Import data could not be read. Please try a different file.', 'widget-importer-exporter' ),
                '',
                array( 'back_link' => true )
            );
        }
        // Hook before import
        do_action( 'wie_before_import' );
        $data = apply_filters( 'wie_import_data', $data );
        // Get all available widgets site supports
        $available_widgets = wie_available_widgets();
        // Get all existing widget instances
        $widget_instances = array();
        foreach ( $available_widgets as $widget_data ) {
            $widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
        }
        // Begin results
        $results = array();
        // Loop import data's sidebars
        foreach ( $data as $sidebar_id => $widgets ) {
            // Skip inactive widgets
            // (should not be in export file)
            if ( 'wp_inactive_widgets' == $sidebar_id ) {
                continue;
            }
            // Check if sidebar is available on this site
            // Otherwise add widgets to inactive, and say so
            if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
                remove_all_widgets_from_sidebar($sidebar_id);
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'widget-importer-exporter' );
            }
            // Result for sidebar
            $results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();
            // Loop widgets
            foreach ( $widgets as $widget_instance_id => $widget ) {
                $fail = false;
                // Get id_base (remove -# from end) and instance ID number
                $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
                // Does site support this widget?
                if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = __( 'Site does not support widget', 'widget-importer-exporter' ); // explain why widget not imported
                }
                // Filter to modify settings before import
                // Do before identical check because changes may make it identical to end result (such as URL replacements)
                $widget = apply_filters( 'wie_widget_settings', $widget );
                // Does widget with identical settings already exist in same sidebar?
                if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
                    // Get existing widgets in this sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' );
                    $sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go
                    // Loop widgets with ID base
                    $single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
                    foreach ( $single_widget_instances as $check_id => $check_widget ) {
                        // Is widget in same sidebar and has identical settings?
                        if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
                            $fail = true;
                            $widget_message_type = 'warning';
                            $widget_message = __( 'Widget already exists', 'widget-importer-exporter' ); // explain why widget not imported
                            break;
                        }

                    }
                }
                // No failure
                if ( ! $fail ) {
                    // Add widget instance
                    $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                    $single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                    $single_widget_instances[] = (array) $widget; // add it
                    // Get the key it was given
                    end( $single_widget_instances );
                    $new_instance_id_number = key( $single_widget_instances );
                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                    if ( '0' === strval( $new_instance_id_number ) ) {
                        $new_instance_id_number = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset( $single_widget_instances[0] );
                    }
                    // Move _multiwidget to end of array for uniformity
                    if ( isset( $single_widget_instances['_multiwidget'] ) ) {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset( $single_widget_instances['_multiwidget'] );
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }
                    // Update option with new widget
                    update_option( 'widget_' . $id_base, $single_widget_instances );
                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                    update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data
                    // Success message
                    if ( $sidebar_available ) {
                        $widget_message_type = 'success';
                        $widget_message = __( 'Imported', 'widget-importer-exporter' );
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = __( 'Imported to Inactive', 'widget-importer-exporter' );
                    }
                }
                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] =(isset($widget->title) and  $widget->title) ? $widget->title : __( 'No Title', 'widget-importer-exporter' ); // show "No Title" if widget instance is untitled
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
            }
        }
        // Hook after import
        do_action( 'wie_after_import' );
        // Return results
        return apply_filters( 'wie_import_results', $results );
    }
}
if(!function_exists('wie_available_widgets')){
    function wie_available_widgets() {
        global $wp_registered_widget_controls;
        $widget_controls = $wp_registered_widget_controls;
        $available_widgets = array();
        foreach ( $widget_controls as $widget ) {
            if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];
            }

        }
        return apply_filters( 'wie_available_widgets', $available_widgets );
    }
}