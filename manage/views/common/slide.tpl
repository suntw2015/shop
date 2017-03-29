<ul class="nav nav-list">

    {foreach from=$menu_list item=menu}
    <li>
        <a href="{$menu['href']}" class="dropdown-toggle">
            <i class="{$me}"></i>
            <span class="menu-text">{$item['title']}</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        {if !empty($menu['submenu'])}
        <ul class="submenu">
            {foreach from=$menu['submenu'] item=submenu}
            <li>
                <a href="tables.html">
                    <i class="icon-double-angle-right"></i>
                    {$submenu['title']}
                </a>
            </li>
        </ul>
        {/if}
    </li>
    {/foreach}
</ul><!-- /.nav-list -->