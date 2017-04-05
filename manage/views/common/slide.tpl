<ul class="nav nav-list">
    {foreach from=$menu_list item=menu}
    <li>
        <a href="{$menu['href']}" class="dropdown-toggle">
            <i class="{$menu['class']}"></i>
            <span class="menu-text">{$menu['title']}</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        {if !empty($menu['submenu'])}
        <ul class="submenu">
            {foreach from=$menu['submenu'] item=submenu}
            <li>
                <a href="{$submenu['href']}">
                    <i class="icon-double-angle-right"></i>
                    {$submenu['title']}
                </a>
            </li>
            {/foreach}
        </ul>
        {/if}
    </li>
    {/foreach}
</ul><!-- /.nav-list -->