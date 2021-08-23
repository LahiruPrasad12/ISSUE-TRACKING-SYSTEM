<template>
  <div>
    <section v-show="!showContent" style="margin-top: 200px">
      <div class="row">
        <div class="col-lg-12 my-3">
          <div class="pull-right">
            <p
              v-if="editecat.Id !== 0"
              class="title is-1"
              style="text-align: center"
            >
              Edite Sub-category
            </p>
            <p
              v-if="editecat.Id === 0"
              class="title is-1"
              style="text-align: center"
            >
              Add New-subcategory
            </p>
            <hr />
          </div>
        </div>
      </div>

      <div
        class="shadow-lg p-3 mb-5 bg-body rounded"
        style="width: 400px; margin-left: 550px; padding-left: 30px"
      >
        <div style="width: 300px; margin-left: 30px">
          <b-field label="Name">
            <b-input
              v-model="editecat.Name"
              type="text"
              required
              value="john@"
              maxlength="30"
            >
            </b-input>
          </b-field>

          <b-field label="Message">
            <b-input
              v-model="editecat.description"
              maxlength="200"
              type="textarea"
              required
            ></b-input>
          </b-field>

          <div v-show="worningAlert" class="alert alert-danger" role="alert">
            {{ AlertMSG }}
          </div>

          <div class="buttons" style="margin-left: 90px">
            <b-button type="is-success" outlined @click="cancelRequest()"
              >Cancel</b-button
            >
            <b-button
              v-if="editecat.Id !== 0"
              type="is-danger"
              outlined
              :loading="editSubCatStatus"
              @click="updateSubCategory(editecat.Id)"
              >Update data</b-button
            >
            &emsp;
            <b-button
              v-if="editecat.Id === 0"
              type="is-danger"
              :loading="editSubCatStatus"
              outlined
              @click="addCategory(editecat.Id)"
              >Post data</b-button
            >
          </div>
        </div>
      </div>
    </section>

    <!--All category retrieve here-->
    <div v-show="showContent" class="container" style="margin-top: 200px">
      <div class="row">
        <div class="col-lg-12 my-3">
          <div class="pull-right">
            <p class="title is-1 float-left">Sub Categories</p>

            <form class="w-25 p-3 float-right">
              <input
                v-model="search"
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
            </form>
          </div>
        </div>
      </div>
      <hr />

      <b-tooltip
        label="Add your new subcategory under this issue"
        size="is-small"
        multilined
      >
        <b-button
          type="is-success"
          outlined
          label="Add New Subcategory"
          @click="addSubCategory()"
        />
      </b-tooltip>

      <div id="products" class="row view-group" style="margin-top: 50px">
        <div
          v-for="subcategory in filterBlog"
          :key="subcategory.id"
          class="item col-xs-4 col-lg-4"
          style="margin-bottom: 20px; box-shadow: #1a202c"
        >
          <div class="card" style="width: 400px; background-color: #c0c0c0">
            <header class="card-header" style="text-align: center">
              <p class="subtitle is-4" style="color: black">
                <b>{{ subcategory.name }}</b>
              </p>
              <hr />
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content" style="color: black">
              <div class="content">
                {{ subcategory.description }}
                <br />
                <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
              </div>
            </div>
            <footer class="card-footer">
              <!-- <button :id="subcat.id" class="card-footer-item" style="color:black; border: none; background:white" @click="addSubCategory()">Add</button> -->
              <button
                class="card-footer-item"
                style="border: none"
                @click="editeteSubCat(subcategory.id)"
              >
                Edit
              </button>
              <div class="verticalLine"></div>
              <button
                class="card-footer-item"
                style="color: red; border: none"
                @click="confirmCustomDelete(subcategory.id)"
              >
                Delete
              </button>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  validate({ params }) {
    return /^\d+$/.test(params.subcategory)
  },

  data() {
    return {
      slug: this.$route.params,
      subcat: [],
      allSubCat: [],
      editecat: {
        Id: 0,
        Name: '',
        description: '',
      },
      showContent: true,
      worningAlert: false,
      AlertMSG: null,
      editSubCatStatus: false,

      search: '',
    }
  },

  async fetch() {
    try {
      this.subcat = (
        await this.$axios.get(
          'Subcategory/render/' + this.$route.params.subcategory
        )
      ).data
    } catch {}
  },

  computed: {
    filterBlog() {
      return this.subcat.filter((SubCategor) =>
        SubCategor.name
          .toLowerCase()
          .toUpperCase()
          .includes(this.search.toLowerCase().toUpperCase())
      )
    },
  },

  methods: {
    alertCustom() {
      this.$buefy.dialog.alert({
        title: 'Title Alert',
        message:
          '<b>There have no more sub categories </b>, for this main category!',
        confirmText: 'Cool!',
      })
    },

    confirmCustomDelete(categoryID) {
      try {
        this.$buefy.dialog.confirm({
          title: 'Deleting account',
          message:
            'Are you sure you want to <b>delete</b> this category? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: async () => {
            await this.$axios.delete('/subcategory/' + categoryID)
            const postion = await this.subcat.findIndex(
              (x) => x.id === categoryID
            )
            this.subcat.splice(postion, 1)
            this.$buefy.toast.open('Account deleted!')
          },
        })
      } catch {
        this.$buefy.toast.open('Something went wrong!')
      }
    },

    addSubCategory() {
      this.showContent = false
    },

    async addCategory() {
      try {
        this.editSubCatStatus = true
        this.$buefy.toast.open(`Your data is sending...`)
        await this.$axios.post(
          '/Subcategory/' + this.$route.params.subcategory,
          this.editecat
        )
        this.$buefy.toast.open(`Post add success!`)
        this.editSubCatStatus = false
      } catch {
        this.$buefy.toast.open(`Somthing went wrong...Plz try agin later!`)
        this.editSubCatStatus = false
      }
    },

    async editeteSubCat(subCatId) {
      try {
        this.editecat = (
          await this.$axios.get('/subcategory/' + subCatId)
        ).data.data

        /* eslint-disable no-console */

        if (this.editecat.length === 0) {
          alert('something going else')
        } else {
          this.showContent = false
        }
      } catch {}
    },

    async updateSubCategory(subCatID) {
      try {
        this.editSubCatStatus = true
        this.worningAlert = false
        this.$buefy.toast.open(`Your data is sending...`)
        const res = await this.$axios.put(
          '/subcategory/' + subCatID,
          this.editecat
        )

        if (res.status === 200) {
          this.$buefy.toast.open(`Update success!`)
          this.editSubCatStatus = false
        } else {
          this.$buefy.toast.open(`Something went wrong... plz try again!`)
          this.editSubCatStatus = false
        }
      } catch {}
    },

    cancelRequest() {
      this.$router.go()
    },
  },
}
</script>

<style scoped>
.verticalLine {
  border-left: 4px solid #4b42f5;
  height: fit-content;
}
</style>
