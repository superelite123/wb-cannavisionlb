<template>
  <div class="app-container">
    <!--Top Bar-->
    <div class="filter-container">
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
      <el-button class="filter-item" type="primary" icon="el-icon-download">
        {{ $t('table.export') }}
      </el-button>
    </div>
    <!--Archive-->
    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Firstname">
        <template slot-scope="scope">
          <span>{{ scope.row.firstname }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="lastname">
        <template slot-scope="scope">
          <span>{{ scope.row.lastname }}</span>
        </template>
      </el-table-column>
    </el-table>
    <!--./Archive-->
    <!--Pagingation-->
    <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList" />
    <!--./Pagingation-->
  </div>
</template>
<script>
import ArchiveResource from '@/api/contact-person';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
const archiveResource = new ArchiveResource();
export default {
  name: 'ContactPersonList',
  components: { Pagination },
  data() {
    return {
      list: null,
      query: {
        page: 1,
        limit: 10,
        keyword: '',
        role: '',
      },
    };
  },
  created() {
    this.resetNewContactPerson();
    this.getList();
  },
  methods: {
    handleFilter() {
      this.query.page = 1;
    },
    handleCreate() {
    },
    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await archiveResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      console.log(this.list);
      this.loading = false;
    },
    resetNewContactPerson() {
      this.newContactPerson = {
        name: '',
        email: '',
      };
    },
  },
};
</script>
