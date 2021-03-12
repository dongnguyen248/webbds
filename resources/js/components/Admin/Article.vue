<template>
<div class="container">
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Article Table</h3>

                    <div style="width: 200px; display: inline; margin-left: 650px">
                        <select v-model="type" name="Categories" class="form-control" style="width: 200px; display: inline">
                            <option value="all" selected>All Type</option>
                            <option v-for="type in types" :key="type.id" :value="type.id">
                                {{ type.name }}
                            </option>
                        </select>
                        <select v-model="perPage" name="perPage" class="form-control" style="width: 100px; display: inline">
                            <option value="6">06</option>
                            <option value="8">08</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                        </select>
                    </div>

                    <div class="card-tools mt-2">
                        <button class="btn btn-success" @click="newModal()">
                            Add new
                            <i class="fa fa-plus fa-fw"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>
                                    Author
                                </th>
                                <th>Photo</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(article,i) in articles" :key="i">
                                <td>{{ i+1}}</td>
                                <td class="pname">
                                    {{ article.title }}
                                </td>
                                <td>{{ article.type.name }}</td>
                                <td>{{ article.author.name }}</td>
                                <td>
                                    <img v-if="
                                                article.photo != '' &&
                                                    article.photo != null
                                            " class="media-object" v-bind:src="
                                                'images/article/' +
                                                    article.photo
                                            " alt="Photo" />
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit text-blue" @click="editModal(article)"></i>
                                    </a>
                                    /
                                    <a href="#">
                                        <i class="fa fa-trash text-red" @click="
                                                    deleteArticle(article.id)
                                                "></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div>
                <paginate class="paginate" v-model="currentPage" :page-count="totalPage" :prev-text="'Prev'" :next-text="'Next'" :container-class="'pagination'" :page-class="'page-item'" :page-link-class="'page-link'" :prev-link-class="'page-link'" :next-link-class="'page-link'"></paginate>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="articleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ isEdit ? "Edit Article" : "Add new" }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="
                            isEdit ? updateArticle() : createArticle()
                        ">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title: </label>
                            <input v-model="form.title" type="text" name="title" class="form-control" :class="{
                                        'is-invalid': form.errors.has('title')
                                    }" placeholder="Title" required />
                            <has-error :form="form" field="title"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-form-label">Type :</label>
                            <select v-model="form.type_id" name="category" class="form-control">
                                <option value="none" selected>Select Type</option>
                                <option v-for="type in types" :key="type.id" :value="type.id">
                                    {{ type.name }}
                                </option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                                <label for="type" class="col-form-label"
                                    >Author:</label
                                >
                                <select
                                    v-model="form.user_id"
                                    name="author"
                                    class="form-control"
                                >
                                    <option value="none" selected
                                        >Select author</option
                                    >
                                    <option
                                        v-for="author in authors"
                                        :key="author.id"
                                        :value="author.id"
                                    >
                                        {{ author.name }}
                                    </option>
                                </select>
                            </div> -->
                        <div class="form-group row">
                            <label for="photo" class="col-form-label">Photo</label>
                            <div class="input-group col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" @change="chooseFile" accept="image/*" />
                                    <label class="custom-file-label" for="photo">{{ form.photo }}</label>
                                </div>
                            </div>
                        </div>
                        <p class="note" v-if="sizeFile / 1048576 >= 2">
                            Vui lòng chọn hình nhỏ hơn 2MB
                        </p>
                        <editor v-model="form.content" name="content" id="content" class="form-control" placeholder="Content" api-key="6nmno2qwavcv4ufsn0k9xv1bi5q5yoxud5o4thqcsruezhx4" :init="myInit" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" v-if="sizeFile / 1048576 < 2">
                            {{ isEdit ? "Update" : "Create" }}
                        </button>
                        <button disabled class="btn btn-primary" v-else>
                            {{ isEdit ? "Update" : "Create" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import editor from "@tinymce/tinymce-vue";
export default {
    components: {
        editor
    },
    watch: {
        category() {
            this.getArticle();
        },
      
    },
    data() {
        return {
            form: new Form({
                id: "",
                title: "",
                content: " ",
                type_id: '',
                photo: ""
            }),
            articles: [],
            perPage: 8,
            currentPage: 1,
            totalPage: 1,
            isEdit: false,
            image: "",
            type: "all",
            types: [],
            authors: [],
            sizeFile: 0,
            sortCol: "id",
            sortType: "desc",
            myInit: {
                selector: "#content",
                height: 500,
                statusbar: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table paste code help wordcount"
                ],
                toolbar: "undo redo | formatselect | fontselect | fontsizeselect|" +
                    "bold italic backcolor | alignleft aligncenter " +
                    "alignright alignjustify | bullist numlist outdent indent | " +
                    "removeformat | help",
                image_title: true,
                automatic_uploads: true,
                file_picker_types: "image",
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement("input");
                    input.setAttribute("type", "file");
                    input.setAttribute("accept", "image/*");
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();

                        reader.onload = function () {
                            var id = "blobid" + new Date().getTime();
                            var blobCache =
                                tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(",")[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        };
    },
    methods: {
        getAricleBySort(col) {
            this.currentPage = 0;
            if (col + "asc" == this.sortCol + this.sortType) {
                this.sortType = "desc";
            } else {
                this.sortType = "asc";
            }
            this.sortCol = col;
            this.currentPage = 1;
            this.getArticle();
        },

        newModal() {
            this.isEdit = false;
            this.sizeFile = 0;
            this.form.reset();
            this.form.clear();
            $("#articleModal").modal("show");
        },
        editModal(article) {
            this.isEdit = true;
            this.form.clear();
            this.form.reset();
            this.sizeFile = 0;
            $("#articleModal").modal("show");
            this.form.fill(article);
        },

        getArticle() {
            this.$Progress.start();
            axios
                .get("/api/article", {
                    params: {
                        page: this.currentPage,
                        type: this.type,
                        sortCol: this.sortCol,
                        sortType: this.sortType,
                        perPage: this.perPage
                    }
                })
                .then(({
                    data
                }) => {
                    this.articles = data.articles.data;
                    this.totalPage = data.articles.last_page;
                });
            this.$Progress.finish();
        },
        getCategory() {
            axios.get("/api/type").then(({
                data
            }) => {
                this.types = data.type.data;
            });
        },
        chooseFile(event) {
            let fileData = event.target.files[0];
            this.form.photo = fileData.name;
            this.sizeFile = fileData.size;
            this.image = fileData;
        },
        createArticle() {
            const formData = new FormData();
            formData.set("image", this.image);
            formData.set("title", this.form.title);
            formData.set("content", this.form.content);
            formData.set("type_id", this.form.type_id);
            axios.post("/api/article", formData).then(() => {
                $("#articleModal").modal("hide");
                this.image = "";
                this.getArticle();
                Toast.fire({
                    icon: "success",
                    title: "Creaed article in successfully"
                });
            });
        },
        updateArticle() {
            const formData = new FormData();
            formData.set("image", this.image);
            formData.set("title", this.form.title);
            formData.set("content", this.form.content);
            formData.set("type_id", this.form.type_id);
            axios
                .post("/api/article/" + this.form.id, formData)
                .then(() => {
                    $("#articleModal").modal("hide");
                    this.image = "";
                    this.getArticle();
                    Toast.fire({
                        icon: "success",
                        title: "Updated Article in successfully"
                    });
                });
        },
        deleteArticle(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/article/" + id)
                        .then(response => {
                            Swal.fire(
                                "Deleted!",
                                "Article has been deleted.",
                                "success"
                            );
                            this.getArticle();
                        })
                        .catch(() => {
                            Swal.fire(
                                "Failed!",
                                "There was something wronge.",
                                "warning"
                            );
                        });
                }
            });
        }
    },
    mounted() {
        this.getArticle();
        this.getCategory();
    }
};
</script>

<style lang="css" scoped>
.card {
    height: 750px;
}

.media-object {
    display: inline-block;
    height: 64px;
    width: 64px;
}

.note {
    font-size: 14px;
    color: red;
    font-style: italic;
}

i {
    color: #e1e6e6;
    transition: color 0.2s ease-in-out;
}

i.active {
    color: #82dfb0;
}

th,
td {
    width: 8.34%;
    padding: 7px;
    margin: auto;
}

/* .description {
    width: 25%;
} */
.pname {
    width: 30%;
}

.modal .modal-dialog {
    min-width: 1000px;
}
</style>
