import Navigo from "navigo";
import Repositories from "../../prototypes/Repositories";

// 기본 템플릿 정의
import TemplateListDefault from "./hbs/list_default.hbs";
import TemplateListTableWrapper from "./hbs/list_table_wrapper.hbs";
import TemplateViewWrapper from "./hbs/view_wrapper.hbs";
import TemplateNotFound from "./hbs/not_found.hbs";

// Route 정의
const pathName = window.location.pathname.split("/")[1];
const router = new Navigo(pathName);

class Article {
  constructor(element = "contentContainer", options = {}) {
    this.el = document.getElementById(element);
    this.loader = document.getElementById("loadWrapper");
    this.loader.classList.add("d-block");
    if (!this.el) {
      alert("존재하지 않는 아이디입니다.");
    }

    this.options = Object.assign({}, Article.options, options);

    // 라우터설정
    router
      .on("/list", (route) => {
        this.list(route);
      })
      .on("/list/:id", async (route) => {
        // 슬러거 라우터로 리다이렉트
        const apiUrl = `${WEBAPP_CONFIG.openApiPrefix}/articles?${this.options.listIdColumn}=${route.data.id}`;
        const data = await this.getListApiUrl(apiUrl);
        return router.navigate(
          `/list/${data.category.id}/${data.category.slug}`
        );
      })
      .on("/list/:id/:slug", async (route) => {
        const apiUrl = `${WEBAPP_CONFIG.openApiPrefix}/articles?${this.options.listIdColumn}=${route.data.id}`;
        const data = await this.getListApiUrl(apiUrl);
        if (route.data.slug !== data.category.slug) {
          return router.navigate(
            `/list/${data.category.id}/${data.category.slug}`
          );
        }
        this.list(route, data);
      })
      .on("/view/:id", async (route) => {
        const apiUrl = `${WEBAPP_CONFIG.openApiPrefix}/articles/${route.data.id}`;
        const data = await this.getViewApiUrl(apiUrl);
        return router.navigate(`/view/${data.id}/${data.slug}`);
      })
      .on("/view/:id/:slug", async (route) => {
        const apiUrl = `${WEBAPP_CONFIG.openApiPrefix}/articles/${route.data.id}`;
        const data = await this.getViewApiUrl(apiUrl);
        if (route.data.slug !== data.slug) {
          return router.navigate(`/view/${data.id}/${data.slug}`);
        }
        this.view(route, data);
      })
      .on("*", (route) => {
        const message = `존재하지 않는 페이지입니다. ${route.url}`;
        this.el.innerHTML = TemplateNotFound(message);
        this.loader.classList.add("d-none");
      })
      .resolve();
  }

  list(route, data) {
    const self = this;
    // 리스트 렌더링
    const typeStr = data.category?.type_str ?? "list";
    self.el.innerHTML = self.templateWrapper(typeStr, data);
    const dataWrapper = self.el.querySelector(".data-wrapper");
    dataWrapper.innerHTML = "";
    const moreBtn = self.el.querySelector(".btn-more");
    moreBtn.dataset.link = data.links.next;

    const wrapperType = typeStr === "list" ? "table" : "ul";
    self._renderList(wrapperType, data, dataWrapper);

    moreBtn.onclick = async (e) => {
      e.preventDefault();
      self.loader.classList.add("d-block");
      const dataWrapper = self.el.querySelector(".data-wrapper");
      const link = e.target.dataset.link;
      const nextData = await this.getListApiUrl(link);

      if (nextData.links.next) {
        moreBtn.dataset.link = nextData.links.next;
      } else {
        return e.target.classList.add("d-none");
      }
      self._renderList(typeStr, nextData, dataWrapper);
      self.loader.classList.add("d-none");
    };

    self.loader.classList.add("d-none");
  }

  _renderList(typeStr, data, dataWrapper) {
    const self = this;
    data = Object.assign(data, {
      root: router.root,
    });
    dataWrapper.innerHTML += self.template(typeStr, data, dataWrapper);
  }

  async getListApiUrl(apiUrl) {
    const self = this;
    const data = await Repositories.get(apiUrl).then(async (result) => {
      if (WEBAPP_CONFIG.appDebug) {
        console.log(result.data);
      }
      return result.data;
    });

    if (!data.category) {
      alert("카테고리가 존재하지 않습니다.");
      location.replace(window.history.back());
      return;
    }

    return data;
  }

  view(route, data) {
    const self = this;
    self.el.innerHTML = self.templateWrapper("view", data);
    self.loader.classList.add("d-none");
  }

  async getViewApiUrl(apiUrl) {
    const self = this;
    const data = await Repositories.get(apiUrl).then(async (result) => {
      if (WEBAPP_CONFIG.appDebug) {
        console.log(result.data.datas);
      }
      return result.data.datas;
    });

    if (!data) {
      alert("데이터가 존재하지 않습니다.");
      location.replace(window.history.back());
      return;
    }
    return data;
  }

  templateWrapper(typeName, data) {
    let bindTemplate;
    switch (typeName) {
      case "table":
        bindTemplate = TemplateListTableWrapper(data);
        break;
      case "ul":
        bindTemplate = TemplateListUlWrapper(data);
        break;
      case "view":
        bindTemplate = TemplateViewWrapper(data);
        break;
      default:
        bindTemplate = TemplateListTableWrapper(data);
        break;
    }
    return bindTemplate;
  }

  template(typeName, data, listWrap) {
    let bindTemplate;
    switch (typeName) {
      case "list":
        listWrap.classList.add(`template-list-default`);
        bindTemplate = TemplateListDefault(data);
        break;
      default:
        listWrap.classList.add("list-default");
        bindTemplate = TemplateListDefault(data);
        break;
    }
    return bindTemplate;
  }
}

Article.options = {
  customListType: false,
  listIdColumn: "article_categories",
  listSlugColumn: "slug",
  viewIdColumn: "id",
  viewSlugColumn: "slug",
  isRedirectSlug: false,
};

export default Article;
