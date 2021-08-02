class Comment_generator {
    static create_element(type, e_id = null, e_class = null, e_att = {}, e_parrent = null, content = null) {
        let element = document.createElement(type)
        if (e_id) {
            element.id = e_id
        }
        if (e_class) {
            element.className = e_class;
        }
        if (Object.keys(e_att).length !== 0) {
            Object.keys(e_att).forEach(key => {
                element.setAttribute(key, e_att[key])
            })
        }
        if (content) {
            element.innerHTML = content
        }
        if (e_parrent) {
            e_parrent.appendChild(element)
        }
        return element
    }
    createTopic(title, id, description, date, author_name, author_id) {
        let row = Comment_generator.create_element("tr", id)
        let col1 = Comment_generator.create_element("td", null, "p-3 col col-6", {}, row)
        Comment_generator.create_element("a", null, "link-dark h3", { "href": `/topic/${id}` }, col1, title)
        Comment_generator.create_element("p", "topic-description", null, {}, col1, description)
        if (readCookie("user") && readCookie("user") === author_id) {
            Comment_generator.create_element("a", null, "link-dark align-top", { "href": "#", "onclick": `delett(${id})` }, col1, "Delete")
        }
        Comment_generator.create_element("td", null, "p-3 col col-lg-1 align-middle", {}, row, date)
        Comment_generator.create_element("td", null, "p-3 col col-lg-1 align-middle", {}, row, author_name)
        return row
    }

    create_comment(user, user_id, date, text, id) {
        let comm = Comment_generator.create_element("li", id)
        let card = Comment_generator.create_element("div", null, "card mb-3", {}, comm)
        let row = Comment_generator.create_element("div", null, "row g-0", {}, card)
        let colimage = Comment_generator.create_element("div", null, "col-md-1", {}, row)
        let src = "https://cdn.iconscout.com/icon/free/png-256/user-1648810-1401302.png"
        Comment_generator.create_element("img", null, "img-fluid rounded-start", { "src": src }, colimage)
        let textcar = Comment_generator.create_element("div", null, "col-md-11", {}, row)
        let cardbody = Comment_generator.create_element("div", null, "card-body", {}, textcar)
        Comment_generator.create_element("h5", "card-title", "card-title", {}, cardbody, user)
        Comment_generator.create_element("small", "comment-date", "text-muted", {}, cardbody, date)
        Comment_generator.create_element("p", "comment-text", "card-text", {}, cardbody, text)
        if (readCookie("user")) {
            let add_delete = Comment_generator.create_element("div", null, "row g-0", {}, cardbody)
            Comment_generator.create_element("a", "added", "col-md-auto link-secondary", { "herf": "#", "data-bs-toggle": "modal", "data-bs-target": "#exampleModal", "data-bs-whatever": id }, add_delete, "Add comment")
            if (readCookie("user") === user_id) {
                Comment_generator.create_element("a", null, "col-md-auto ms-2 link-secondary", { "onclick": `deletc(${id})` }, add_delete, "Delete")
            }
        }
        Comment_generator.create_element("ul", "child_" + id, "list-unstyled ps-5", {}, comm)
        return comm;
    }
}

$(document).ready(function () {
    let topic = $(location).attr("href").split("/")[4]
    if ($("ul").is("#list_comments")) {
        $.post("/data/" + topic, {}, function (topic_data) {
            if (topic_data.length !== 0) {
                $("#topic-title").text(topic_data.title);
                $("#topic-props").text(`${topic_data.author_login} , ${topic_data.date}`)
                $("#topic-text").text(topic_data.description)
                if (readCookie("user")) {
                    Comment_generator.create_element("a", "added", "col-md-auto link-secondary", { "herf": "#", "data-bs-toggle": "modal", "data-bs-target": "#exampleModal", "data-bs-whatever": 0 }, document.getElementById("topic"), "Add comment")
                }
            }
            else {
                $("#topic-title").text("Тема ещё не создана");
            }
        }, "json")
        $.post("/get/" + topic, {}, function (data) {
            if (data.length !== 0) {
                showComments(data);
            }
        }, "json");
    }
    else if ($("table").is("#topic-list")) {
        $.post('/table', {}, showTopics, "json")


    }

    //Вызов модального окна и добавление нового комментария
    if ($("div").is("#exampleModal")) {
        let exampleModal = document.getElementById('exampleModal')
        let myModal = new bootstrap.Modal(exampleModal)
        let modalBodyInput = exampleModal.querySelector('.modal-body textarea')
        let ids
        exampleModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget
            ids = button.getAttribute('data-bs-whatever')
            modalBodyInput.value = " "
        })
        let sendBtn = document.getElementById('send-btn')
        sendBtn.addEventListener('click', function () {
            if (modalBodyInput.value !== '') {
                $.post("/add/" + topic, { text: modalBodyInput.value, parrent_id: ids }, function (data) {

                    let par_id = "list_comments"
                    if (ids !== "0") {
                        par_id = "child_" + ids
                    }
                    let parrent = document.getElementById(par_id)
                    let child = new Comment_generator().create_comment(data.user_name, data.user_id, data.date, data.text, data.id)
                    parrent.prepend(child);

                }, "json");
            }
            myModal.hide()
        })
    }

    if ($("div").is("#topicModal")) {
        let topicModal = document.getElementById('topicModal')
        let myModal = new bootstrap.Modal(topicModal)
        let modalBodyTextarea = topicModal.querySelector('.modal-body textarea')
        let modalBodyInput = topicModal.querySelector('.modal-body input')
        topicModal.addEventListener('show.bs.modal', function (event) {
            modalBodyInput.value = " "
        })
        let sendBtn = document.getElementById('send-btn')
        sendBtn.addEventListener('click', function () {
            if (modalBodyInput.value !== '') {
                $.post("/addtop", { title: modalBodyInput.value, description: modalBodyTextarea.value }, function (data) {
                    let parrent = document.getElementById("table-head")
                    let child = new Comment_generator().createTopic(data.title, data.id, data.description, data.date, readCookie("user"), data.author_id)
                    parrent.insertAdjacentElement("afterEnd", child);

                }, "json");
            }
            myModal.hide()
        })
    }



    function showComments(datas) {
        datas.forEach(comment => {
            let list = $("#list_comments")
            let id = comment.parrent_id
            if (id) {
                list = $(`#child_${comment.parrent_id}`);
            }
            const commet_array = new Comment_generator().create_comment(comment.user_name, comment.user_id, comment.date, comment.text, comment.id)
            list.append(commet_array)
            if (comment.child && comment.child.length) {
                showComments(comment.child);
            }
        })
    }

    function showTopics(data) {
        data.forEach(topics => {
            let list = $("#topic-list")
            const theme = new Comment_generator().createTopic(topics.title, topics.id, topics.description, topics.date, topics.user_name, topics.author_id);
            list.append(theme);
        })
    }

})
function deletc(id) {
    let result = confirm('Delete comment?');
    if (result) {

        $.post("/delete/comment", { id: id }, function (data) {
            document.getElementById(id).remove();
        })

    }
}

function delett(id) {
    let result = confirm('Delete topic?');
    if (result) {
        $.post("/delete/topic", { id: id }, function (data) {
            document.getElementById(id).remove();
        })
    }
}

function readCookie(name) {
    var name_cook = name + "=";
    var spl = document.cookie.split(";");
    for (var i = 0; i < spl.length; i++) {
        var c = spl[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(name_cook) == 0) {
            return c.substring(name_cook.length, c.length);
        }
    }
    return null;
}