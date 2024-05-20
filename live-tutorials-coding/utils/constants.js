var Constants = {
  API_BASE_URL: "http://localhost:8018/web-introduction/live-backend/",
};

var Constants = {
  get_api_base_url: function () {
    if (location.hostname == "localhost") {
      return "http://localhost:8018/web-introduction/live-backend/";
    } else {
      return "https://oyster-app-owmtr.ondigitalocean.app/live-backend/";
    }
  },
};
