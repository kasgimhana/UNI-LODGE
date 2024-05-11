<?php
include 'essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel : Articles</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'header.php'; ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Article Management</h3>

                <!-- Articles Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Articles</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                                <i class="bi bi-plus"></i>
                                Add New Article
                            </button>
                        </div>
                        <div id="articles_list">
                        </div>
                    </div>
                </div>
                <!-- Article Modal -->
                <div class="modal fade" id="editArticleModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="edit_article_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add/Edit Article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="article_id">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Title</label>
                                        <input type="text" id="article_title_input" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Content</label>
                                        <textarea id="article_content_input" class="form-control shadow-none" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Article Modal -->
                <div class="modal fade" id="addArticleModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="add_article_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add/Edit Article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="article_id">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Title</label>
                                        <input type="text" id="add_article_title_input" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Content</label>
                                        <textarea id="add_article_content_input" class="form-control shadow-none" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'scripts.php'; ?>

    <script>
        let add_article_form = document.getElementById('add_article_form');
        let edit_article_form = document.getElementById('edit_article_form');

        let article_id = document.getElementById('article_id');
        let article_title_input = document.getElementById('article_title_input');
        let article_content_input = document.getElementById('article_content_input');

        add_article_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_new_article()
        });

        edit_article_form.addEventListener('submit', function(e) {
            e.preventDefault();
            update_article_data(article_id.value, article_title_input.value, article_content_input.value)
        });


        function get_article_data() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/articles_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                article_data = JSON.parse(this.responseText);

                let articlesList = document.getElementById('articles_list');
                articlesList.innerHTML = ''; // Clear existing content

                // Loop through the article data and create HTML for each article
                article_data.forEach(article => {
                    let articleHTML = `
            <div class="article card border-0 shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">${article.article_title}</h5>
                    <p class="card-text">${article.article_content}</p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary btn-sm edit_button me-2" onclick="populateModal(${article.id_no},'${article.article_title}','${article.article_content}')" data-bs-toggle="modal" data-bs-target="#editArticleModal">Edit</button>
                        <button class="btn btn-outline-danger btn-sm delete_button" onclick="deleteArticle(${article.id_no})">Delete</button>
                    </div>
                </div>
            </div>
        `;
                    articlesList.insertAdjacentHTML('beforeend', articleHTML);
                });
            }

            xhr.send('get_article_data');
        }

        function update_article_data(article_id, article_title_value, article_content_value) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/articles_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                console.log(this.response);
                var modalReference = document.getElementById('editArticleModal');
                var modal = bootstrap.Modal.getInstance(modalReference);
                modal.hide();

                if (this.responseText == 1) {
                    alert("Success", "Changes saved", "success")
                    get_article_data();
                } else {
                    alert("Attention", "No Changes saved")
                }
            }
            xhr.send('id_no=' + article_id + '&article_title=' + article_title_value + '&article_content=' + article_content_value + '&update_article_data');
        }

        function add_new_article() {
            let title = document.getElementById('add_article_title_input').value;
            let content = document.getElementById('add_article_content_input').value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/articles_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                console.log(this.response);
                var modalReference = document.getElementById('addArticleModal');
                var modal = bootstrap.Modal.getInstance(modalReference);
                modal.hide();

                if (this.responseText == 1) {
                    alert("Success", "Article added successfully", "success")
                    get_article_data();
                } else {
                    alert("Attention", "Failed to add article")
                }
            }

            xhr.send('article_title=' + title + '&article_content=' + content + '&add_new_article');
        }

        function deleteArticle(articleId) {
            if (confirm("Are you sure you want to delete this article?")) {

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/articles_crud.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert("Success", "Article deleted successfully", "success")
                        get_article_data();
                    } else {
                        alert("Attention", "Failed to delete article")
                    }
                }

                xhr.send('id_no=' + articleId + '&delete_article');
            }
        }

        function populateModal(id, title, content) {
            document.getElementById('article_id').value = id;
            document.getElementById('article_title_input').value = title;
            document.getElementById('article_content_input').value = content;
        }

        window.onload = function() {
            get_article_data();
        }
    </script>

</body>

</html>