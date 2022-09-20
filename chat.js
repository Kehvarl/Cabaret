function get_posts()
{
    fetch('api.php/load')
        .then(res => res.json())
        .then((out) => {
            render_posts(out);
        }).catch(err => console.error(err));

    setTimeout(function(){get_posts()}, 2.0*1000);
}

async function post_message(post)
{
    const response = await fetch('api.php/post', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
        body: JSON.stringify(post)
    });
    return response.json();
}

async function clear()
{
    const response = await fetch('api.php/reset', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer'
    });
    return response.json();
}

function doClear() {
    clear().then(data => {console.log(data);});
}

function doPost()
{
    let name = document.getElementById("Name").value;
    let message = document.getElementById("Message").value;
    let color = document.getElementById("Color").value;
    let font = document.getElementById("Font").value;
    document.getElementById("Message").value = "";
    post_message({name: name, message: message, color: color, font:font})
        .then(data => {console.log(data);});
    get_posts();
}

function render_posts(room_data)
{
    let obj = document.getElementById("posts");
    let scrolldown =  obj.scrollTop === (obj.scrollHeight - obj.offsetHeight);
    obj.innerHTML = "";
    room_data['posts'].forEach((p)=>
    {
        let ret = "<div class='post' style='color: "+p['color']+";";
        if(p['font'])
        {
            ret += "font-family: "+p['font']+";";
        }
        ret += "'>";
        ret += "<span class='name'>"+p['display_name']+"</span> ";
        ret += "<span class='message'>"+p['message']+"</span> ";
        ret += "<span class='time'>"+p['date_time']+"</span></div>";
        obj.innerHTML += ret;
        if(scrolldown)
            obj.scrollTop = obj.scrollHeight;
    });
}