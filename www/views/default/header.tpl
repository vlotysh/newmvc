<html>
    <head>
        <title>{$pageTitle}</title>
        <link rel="stylesheet" href="{$templateWebPath}css/style.css" />
        <script type='text/javascript' src="{$templateWebPath}js/jquery-1.7.2.js"></script>
        <script type='text/javascript' src="{$templateWebPath}js/main.js"></script>
        
         {literal}
            <script type="text/javascript">
    for(var i = 0; i == 1; i++)       
    location = location.href;
                
            </script>
        {/literal}
    </head>
    <body>
        

        <div id="wrapper"> 

            <div id="header">
                <h1>My shop </h1>
            </div>

            <!-- 
            хлебных крошки временное решение
            в будущем желательно реализовать функции которая вернет сразу всю строчку
            -->   
            <div class="breadcrumbs" style="height: 20px; margin-bottom: 5px;">

                {if $rsOneCategory['parent_id'] != 0}    
                    {if $rsCategory['name'] != null}
                        <a href="/"style="margin-right: 5px;">На  главную</a> → 
                        
                        {foreach $rsCategories as $item}

                        <a href="/category/{$rsOneCategory['parent_id']}/" style="margin-right: 5px;"> {if $rsOneCategory['parent_id'] == $item['id']}  {$item['name']}{/if}</a> 
                        {/foreach}

                            → <span style="margin-left: 5px;">{$rsCategory['name']}</span>


                            {/if}

                                {/if}
                                
                                 {if $rsOneCategory['parent_id'] == 0 && $rsOneCategory['id']} 
                                <a href="/"style="margin-right: 5px;">На  главную</a> →   <span style="margin-left: 5px;">{$rsCategory['name']}</span>
                                  {/if}   
                                    {if $rsProduct['name']}
                                        <a href="/" style="margin-right: 5px;">На  главную</a> → 
                                        {foreach $rsCategories as $item}

                                            <a href="/category/{$rsOneCategory['parent_id']}/" style="margin-right: 5px;"> {if $rsOneCategory['parent_id'] == $item['id']}  {$item['name']}{/if}</a> 
                                        {/foreach}
                                        → <a href="/category/{$rsOneCategory['id']}/" style="margin-left: 5px;">{$rsOneCategory['name']}</a>  →   <span style="margin-left: 5px;">{$rsProduct['name']}</span>

                                    {/if}  
                                    
                                    {if $controllerNamew === 'Сart'}
                                        <a href="/"style="margin-right: 5px;">На  главную</a> →   <span style="margin-left: 5px;">Корзина</span>
                                        {/if}
                                </div>

                                <!-- 
                                         хлебных крошки закончились =)
                                -->  
                                
                                <div class="clear"></div>
                               
                                {include file='leftcolumn.tpl'}    


                                <div class="centerColumn">

