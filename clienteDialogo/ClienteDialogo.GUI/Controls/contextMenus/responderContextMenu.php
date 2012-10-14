
<style>
    /* Generic context menu styles */
    .contextMenu {
        position: absolute;
        width: 180px;
        z-index: 9999999;
        border: solid 1px #ff6600;
        background: #DDDDDD;
        padding: 0px;
        margin: 0px;
        display: none;
    }

    .contextMenu li {
        list-style: none;
        padding: 0px;
        margin: 0px;
        background-color: #DDDDDD;
    }

    .contextMenu a {
        color: #333;
        text-decoration: none;
        display: block;
        line-height: 20px;
        height: 20px;
        background-position: 6px center;
        background-repeat: no-repeat;
        outline: none;
        padding: 1px 5px;
        padding-left: 28px;
    }

    .contextMenu li.hover a {
        color: #FFF;
        background-color: #3399FF;
    }

    .contextMenu li.disabled a {
        color: #AAA;
        cursor: default;
    }

    .contextMenu li.hover.disabled a {
        background-color: transparent;
    }

    .contextMenu li.separator {
        border-top: solid 1px #CCC;
    }

    /*
            Adding Icons
            
            You can add icons to the context menu by adding
            classes to the respective LI element(s)
    */

    .contextMenu li.edit a { background-image: url(images/page_white_edit.png); }
    .contextMenu li.cut a { background-image: url(images/cut.png); }
    .contextMenu li.copy a { background-image: url(images/page_white_copy.png); }
    .contextMenu li.paste a { background-image: url(images/page_white_paste.png); }
    .contextMenu li.delete a { background-image: url(images/page_white_delete.png); }
    .contextMenu li.quit a { background-image: url(images/door.png); }

</style>
<ul id="myMenu" class="contextMenu" >
    
    <li>
        <a href="#respondeParrafo">Responder párrafo</a>
    </li>
    <li>
        <a href="#respondeTodo">Responder a todo</a>
    </li>
</ul>

