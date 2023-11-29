$(function(){
    
    $("#mainsite").hide();
    $("#LogIn").hide();

    let res;
    let forumUser;
   
    $("#log").on("click",()=>{
        $("#CreateNewUser").hide();
        $("#LogFirstName").val("") 
        $("#LogLastName").val("")
        $("#LogIn").show();
    })

    $("#create").on("click",()=>{
        $("#LogIn").hide();
        $("#NewUserFirstName").val("") 
        $("#NewUserLastName").val("")
        $("#CreateNewUser").show();
    })


    $("#userops").on("click",()=>{
        $("#mainsite").hide()
        $("#allpost").text("")
        $("#userops").css("visibility","hidden")
        $("#CreateNLog").show()
    })

    $("#userbttn").on("click", ()=>{
        $("#userlogout").text(forumUser.username)
        $("#userops").css("visibility","visible");
    })

    $("#createAcc").on("click",()=>{
        let username = $("#NewUserFirstName").val() + " " + $("#NewUserLastName").val();
        try {
            if (username == ""){
                throw new Error("Invalid credentials")
            }

            $.ajax({
                url:"http://hyeumine.com/forumCreateUser.php",
                method: "POST",
                data: {username},
                success: (data)=>{
                    forumUser = JSON.parse(data);
                    console.log(forumUser);
                    $("#CreateNLog").hide();
                    $("#mainsite").show();
                    getForumPosts();
                    $("#userhandle").text(forumUser.username);
                }
            })
        } catch(error){
            alert(error.message)
        }
    })

    $("#logAcc").on("click",()=>{
        let username = $("#LogFirstName").val() + " " + $("#LogLastName").val()
        try {
            if (username == ""){
                throw new Error("Invalid credentials")
            }
    
            $.ajax({
                url:`http://hyeumine.com/forumLogin.php`,
                method: "POST",
                data: {username},
                success: (data)=>{
                    obj = JSON.parse(data);
    
                    if(!obj.success){
                        alert("User not found!");
                    } else {
                        forumUser = obj.user;
                        console.log(forumUser);
                        $("#CreateNLog").hide();
                        $("#mainsite").show();
                        getForumPosts();
                        $("#userhandle").text(forumUser.username);
                    }
                }
            })
        } catch(error){
            alert(error.message)
        }
    })

    $("#handlePost").on("click", ()=>{
        let uid = forumUser.id;
        let obj = {id: uid, post: $("#newPost").val()};
        $.ajax({
            url: "http://hyeumine.com/forumNewPost.php",
            method:"POST",
            data: obj,
            success: (data) => {
                obj = JSON.parse(data);
                $("#newPost").val("")
                getForumPosts();
                
            }
        })
    })

    $("#refresh").on("click", ()=>{
        getForumPosts();
    })

    async function forumDeletePost(post_id){
        try {
            $.ajax({
                url: `http://hyeumine.com/forumDeletePost.php?id=${post_id}`,
                method: "Get",
                success: (data)=>{
                    if (!data && !data.success){
                        throw new Error("Post deletion did not push through...");
                    } else {
                        getForumPosts();
                        alert("Deleted successfully!")
                    }
                }
            })
        } catch(error){
            alert(error.message)
        }
    }

    async function forumReplyPost(e){
        post_id = $(e).attr("value")
        post = $(e).prev().val()
        $(e).prev().val("")
        uid = forumUser.id

        try {
            $.ajax({
                url: "http://hyeumine.com/forumReplyPost.php",
                method: "POST",
                data: {user_id: uid,post_id: post_id, reply: post},
                success: (data)=>{
                    obj = JSON.parse(data);
                    if (!obj.success){
                        throw new Error("Reply not sent...")
                    } 

                    getForumPosts();
                    $("#posts").text("")
                }
            })
        } catch(error){
            alert(error.message)
        }
    }


    async function forumDeleteReply(reply_id){
        try {
            $.ajax({
                url: `http://hyeumine.com/forumDeleteReply.php?id=${reply_id}`,
                method: "Get",
                success: (data)=>{
                    if (!data && !data.success){
                        throw new Error("Reply deletion did not push through...");
                    } else {
                        getForumPosts();
                        alert("Reply deleted successfully!")
                    }
                }
            })
        } catch(error){
            alert(error.message)
        }
    }

    async function getForumPosts(){
        try {
            $.ajax({
                url:"http://hyeumine.com/forumGetPosts.php",
                method:"POST",
                success: (data)=>{
                    obj = JSON.parse(data);
                    obj = obj.reverse();
                    res = "";
                    obj.forEach(element => {
                        getIndivPost(element)
                    });

                    $("#allpost").html(res);
                    $(".handleDel").on("click",(e)=>{
                        forumDeletePost($(e.target).attr("value"))
                    })

                    $(".handleReply").on("click",(e)=>{
                        forumReplyPost(e.target)
                    })

                    $(".handleDelReply").on("click",(e)=>{
                        forumDeleteReply($(e.target).attr("value"))
                    })
                }
            })
        } catch(error){
            alert(error.message)
        }
    }

    async function withReply(reply){
        obj = reply
        res += `<div class="replies">`
        obj.forEach(reply => {
            res += `<div class="indivreply">
                <section class="boogsh">
                <div class="replyusers">${reply.user}</div>
                <div class="replyreply">${reply.reply}</div>
                </section>`

               if(reply.uid == forumUser.id){
                    res += `<button value="${reply.id}" class="handleDelReply" type="button">🗑</button>`
               }
            res+= `</div>`
        })
        res += "</div>"
    }

    async function getIndivPost(element){
        res += `<div class="posts">
                <section class="withdel">
                <h2>${element.user}</h2>`
               

            if (element.uid == forumUser.id){
                res += `<button type="button" class="handleDel" value="${element.id}">🗑</button>`
            }

        res += `</section><div class="date">${element.date}</div>
                <div class="posttext">${element.post}</div>
                <section class="replySection">
                    <input name="replyArea" type="text" class="replyText" placeholder="reply something...">
                    <button value="${element.id}" class="handleReply" type="reset">Reply</button>
                </section>`
                
        if (element.hasOwnProperty('reply')){
            withReply(element.reply)
        }
        res += `</div>`
    }
}) 