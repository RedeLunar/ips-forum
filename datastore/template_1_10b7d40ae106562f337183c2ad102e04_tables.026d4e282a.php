<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_core_admin_tables extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '149ec079a114cd3e9e41124eba52ed53';\n\tfunction content( $content ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div data-ipsTruncate data-ipsTruncate-size=\"5 lines\">\n\t{$content}\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction rows( $table, $headers, $rows ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( empty( $rows ) ):\n$return .= <<<CONTENT\n\n\t<tr>\n\t\t<td colspan=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\count( $headers ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\t<div class='ipsPad_double ipsType_light'>\n\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\nCONTENT;\n\nif ( ( isset( $table->rootButtons['add'] ) ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t&nbsp;&nbsp;\n\t\t\t\t\t<a \n\t\t\t\t\t\t\nCONTENT;\n\nif ( isset( $table->rootButtons['add']['link'] ) ):\n$return .= <<<CONTENT\nhref='\nCONTENT;\n$return .= htmlspecialchars( $table->rootButtons['add']['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\ttitle='\nCONTENT;\n\n$val = \"{$table->rootButtons['add']['title']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n'\n\t\t\t\t\t\tclass='ipsButton ipsButton_alternate ipsButton_small \nCONTENT;\n\nif ( isset( $table->rootButtons['add']['class'] ) ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $table->rootButtons['add']['class'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'\n\t\t\t\t\t\trole=\"button\"\n\t\t\t\t\t\t\nCONTENT;\n\nif ( isset( $table->rootButtons['add']['data'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $table->rootButtons['add']['data'] as $k => $v ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\tdata-\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n=\"\nCONTENT;\n$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\n\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nif ( isset( $table->rootButtons['add']['hotkey'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\tdata-keyAction='\nCONTENT;\n$return .= htmlspecialchars( $table->rootButtons['add']['hotkey'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t>\nCONTENT;\n\n$val = \"{$table->rootButtons['add']['title']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t<\/td>\n\t<\/tr>\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nforeach ( $rows as $rowId => $r ):\n$return .= <<<CONTENT\n\n\t\t<tr class='ipsClearfix\nCONTENT;\n\nif ( isset( $table->highlightRows[ $rowId ] ) ):\n$return .= <<<CONTENT\n \nCONTENT;\n$return .= htmlspecialchars( $table->highlightRows[ $rowId ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-keyNavBlock \nCONTENT;\n\nif ( isset( $r['_buttons']['view'] ) ):\n$return .= <<<CONTENT\ndata-tableClickTarget=\"view\"\nCONTENT;\n\nelseif ( isset( $r['_buttons']['edit'] ) ):\n$return .= <<<CONTENT\ndata-tableClickTarget=\"edit\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\nCONTENT;\n\nforeach ( $r as $k => $v ):\n$return .= <<<CONTENT\n\n\t\t\t\t<td class='\nCONTENT;\n\nif ( $k === 'photo' ):\n$return .= <<<CONTENT\nipsTable_icon\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( $k === ( $table->mainColumn ?: $table->quickSearch ) OR $k === 'o_invoice' ):\n$return .= <<<CONTENT\nipsTable_wrap\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( $k === $table->mainColumn ):\n$return .= <<<CONTENT\nipsTable_primary\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( $k === '_buttons' ):\n$return .= <<<CONTENT\nipsTable_controls\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\nif ( isset( $table->rowClasses[ $k ] ) ):\n$return .= <<<CONTENT\n\nCONTENT;\n\n$return .= htmlspecialchars( implode( ' ', $table->rowClasses[ $k ] ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $k !== $table->mainColumn && $k !== '_buttons' && $k !== 'photo' ):\n$return .= <<<CONTENT\ndata-title=\"\nCONTENT;\n\n$val = \"{$table->langPrefix}{$k}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\nCONTENT;\n\nif ( $k === '_buttons' ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\" )->controlStrip( $v );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t{$v}\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/td>\n\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t<\/tr>\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction table( $table, $headers, $rows, $quickSearch ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div data-baseurl=\"\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-resort='\nCONTENT;\n$return .= htmlspecialchars( $table->resortKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-controller=\"core.global.core.table\">\n\t<div class='ipsClearfix'>\n\t\t<div data-role=\"tablePagination\" class='ipsSpacer_bottom'>\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t\t\nCONTENT;\n\nif ( isset( $headers['_buttons'] ) ):\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\" )->buttons( $table->rootButtons, '' );\nendif;\n$return .= <<<CONTENT\n\n\t<\/div>\n\t<div class=\"acpBlock ipsClear\">\n\t\t\nCONTENT;\n\nif ( $quickSearch !== NULL or $table->advancedSearch or !empty( $table->filters ) ):\n$return .= <<<CONTENT\n\n\t\t\t<div class='ipsClearfix ipsClear acpWidgetToolbar' data-role=\"tableSortBar\">\n\t\t\t\t\nCONTENT;\n\nif ( $quickSearch !== NULL or $table->advancedSearch ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nif ( $table->advancedSearch ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<a class='ipsPos_right acpWidgetSearch' data-ipsTooltip aria-label='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n' href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'advancedSearchForm' => '1', 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-ipsDialog data-ipsDialog-title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n'><i class='fa fa-cog'><\/i><\/a>\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nif ( $quickSearch !== NULL ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<input type='text' class='ipsPos_right acpTable_search ipsJS_show' data-role='tableSearch' results placeholder=\"\nCONTENT;\n\nif ( \\is_string( $quickSearch ) ):\n$return .= <<<CONTENT\n\nCONTENT;\n\n$sprintf = array(\\IPS\\Member::loggedIn()->language()->addToStack( $table->langPrefix . $quickSearch )); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search_prefix', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\" value=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Request::i()->quicksearch, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\n\t\t\t\t\nCONTENT;\n\nif ( !empty( $table->filters ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<div class='ipsButtonBar ipsClearfix ipsResponsive_showDesktop'>\n\t\t\t\t\t\t<ul class='ipsButtonRow ipsPos_left ipsClearfix'>\n\t\t\t\t\t\t\t<li data-action=\"tableFilter\" data-filter=\"\">\n\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection, 'filter' => '' ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class='\nCONTENT;\n\nif ( !array_key_exists( $table->filter, $table->filters ) ):\n$return .= <<<CONTENT\nipsButtonRow_active\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $table->filters as $k => $q ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t<li data-action=\"tableFilter\" data-filter=\"\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class='\nCONTENT;\n\nif ( $k === $table->filter ):\n$return .= <<<CONTENT\nipsButtonRow_active\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$val = \"{$k}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t<\/div>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t<div class='ipsButtonBar ipsClearfix ipsResponsive_hideDesktop ipsResponsive_block'>\n\t\t\t\t\t\nCONTENT;\n\nif ( !empty( $table->filters ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<ul class='ipsButtonRow ipsPos_left ipsClearfix'>\n\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t<a href='#elFilterMenu_menu' data-role=\"tableFilterMenu\" id='elFilterMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable=\"radio\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'filter', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n <i class='fa fa-caret-down'><\/i><\/a>\n\t\t\t\t\t\t\t\t<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elFilterMenu_menu'>\n\t\t\t\t\t\t\t\t\t<li data-ipsMenuValue='' class='ipsMenu_item \nCONTENT;\n\nif ( !array_key_exists( $table->filter, $table->filters ) ):\n$return .= <<<CONTENT\nipsMenu_itemChecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'><a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'all', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $table->filters as $k => $q ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t<li class='ipsMenu_item \nCONTENT;\n\nif ( $k === $table->filter ):\n$return .= <<<CONTENT\nipsMenu_itemChecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-action=\"tableFilter\" data-ipsMenuValue='\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'><a href=\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $k, 'sortby' => $table->sortBy, 'sortdirection' => $table->sortDirection ) )->setPage( 'page', 1 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$val = \"{$k}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t<ul class='ipsButtonRow ipsPos_left ipsClearfix'>\n\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t<a href='#elSortMenu_menu' id='elSortMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable=\"radio\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'sort_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n <i class='fa fa-caret-down'><\/i><\/a>\n\t\t\t\t\t\t\t<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elSortMenu_menu'>\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $headers as $k => $header ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nif ( $header !== '_buttons' && !\\in_array( $header, $table->noSort ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t<li class='ipsMenu_item \nCONTENT;\n\nif ( $header == $table->sortBy ):\n$return .= <<<CONTENT\nipsMenu_itemChecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-ipsMenuValue='\nCONTENT;\n$return .= htmlspecialchars( $header, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nif ( $header == $table->sortBy and $table->sortDirection == 'desc' ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $header, 'sortdirection' => 'desc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $header, 'sortdirection' => 'asc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t\t\t\nCONTENT;\n\n$val = \"{$table->langPrefix}{$header}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t\t<\/a>\n\t\t\t\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t<a href='#elOrderMenu_menu' id='elOrderMenu' data-ipsMenu data-ipsMenu-activeClass='ipsButtonRow_active' data-ipsMenu-selectable=\"radio\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'order_by', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n <i class='fa fa-caret-down'><\/i><\/a>\n\t\t\t\t\t\t\t<ul class='ipsMenu ipsMenu_auto ipsMenu_withStem ipsMenu_selectable ipsHide' id='elOrderMenu_menu'>\n\t\t\t\t\t\t\t\t<li class='ipsMenu_item \nCONTENT;\n\nif ( $table->sortDirection == 'asc' ):\n$return .= <<<CONTENT\nipsMenu_itemChecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-ipsMenuValue='asc'>\n\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => 'asc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ascending', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t\t<li class='ipsMenu_item \nCONTENT;\n\nif ( $table->sortDirection == 'desc' ):\n$return .= <<<CONTENT\nipsMenu_itemChecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-ipsMenuValue='desc'>\n\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $table->sortBy, 'sortdirection' => 'desc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'descending', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t\t<\/li>\n\t\t\t\t\t<\/ul>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\n\t\t<div data-role=\"extraHtml\">{$table->extraHtml}<\/div>\n\t\t\n\t\t<table class='ipsTable ipsTable_responsive ipsTable_zebra \nCONTENT;\n\nforeach ( $table->classes as $class ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n \nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n' data-role=\"table\" data-ipsKeyNav data-ipsKeyNav-observe='e d return'>\n\t\t\t<thead>\n\t\t\t\t<tr class='ipsAreaBackground'>\n\t\t\t\t\t\nCONTENT;\n\nforeach ( $headers as $k => $header ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nif ( $header !== '_buttons' ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t<th class='\nCONTENT;\n\nif ( !\\in_array( $header, $table->noSort ) ):\n$return .= <<<CONTENT\nipsTable_sortable \nCONTENT;\n\nif ( $header == ( mb_strrpos( $table->sortBy, ',' ) !== FALSE ? trim( mb_substr( $table->sortBy, mb_strrpos( $table->sortBy, ',' ) + 1 ) ) : $table->sortBy ) ):\n$return .= <<<CONTENT\nipsTable_sortableActive ipsTable_sortable\nCONTENT;\n\nif ( $table->sortDirection == 'asc' ):\n$return .= <<<CONTENT\nAsc\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nDesc\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nipsTable_sortableAsc\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( array_key_exists( $header, $table->classes ) ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $table->classes[ $header ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' data-key=\"\nCONTENT;\n$return .= htmlspecialchars( $header, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" \nCONTENT;\n\nif ( !\\in_array( $header, $table->noSort ) ):\n$return .= <<<CONTENT\ndata-action=\"tableSort\" \nCONTENT;\n\nif ( $header == ( mb_strrpos( $table->sortBy, ',' ) !== FALSE ? trim( mb_substr( $table->sortBy, mb_strrpos( $table->sortBy, ',' ) + 1 ) ) : $table->sortBy ) ):\n$return .= <<<CONTENT\naria-sort=\"\nCONTENT;\n\nif ( $table->sortDirection == 'asc' ):\n$return .= <<<CONTENT\nascending\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\ndescending\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( isset( $table->widths[ $header ] ) ):\n$return .= <<<CONTENT\nstyle=\"width: \nCONTENT;\n$return .= htmlspecialchars( $table->widths[ $header ], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n%\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nif ( !\\in_array( $header, $table->noSort ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nif ( $header == $table->sortBy and $table->sortDirection == 'desc' ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $header, 'sortdirection' => 'asc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $table->baseUrl->setQueryString( array( 'filter' => $table->filter, 'sortby' => $header, 'sortdirection' => 'desc' ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t\nCONTENT;\n\n$val = \"{$table->langPrefix}{$header}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\t\t<span class='ipsTable_sortIcon'><\/span>\n\t\t\t\t\t\t\t\t\t\t<\/a>\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\n$val = \"{$table->langPrefix}{$header}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t<\/th>\n\t\t\t\t\t\t\nCONTENT;\n\nelseif ( $header === '_buttons' ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t<th>&nbsp;<\/th>\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/tr>\n\t\t\t<\/thead>\n\t\t\t<tbody data-role=\"tableRows\">\n\t\t\t\t\nCONTENT;\n\n$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );\n$return .= <<<CONTENT\n\n\t\t\t<\/tbody>\n\t\t<\/table>\n\t<\/div>\n\t<div data-role=\"tablePagination\" class='ipsSpacer_top'>\n\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit );\n$return .= <<<CONTENT\n\n\t<\/div>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
