import Vue from "vue";
import VueFormGenerator from "vue-form-generator";

// Register my awesome field
import fieldPostSelectAjax from "./fields/post_select_ajax.vue";
import fieldOnOff from "./fields/on_off";
import fieldSwitch from "./fields/switch";
import fieldText from "./fields/text";
import fieldTextArea from "./fields/textarea";
import fieldSelect from "./fields/select";

import fieldUpload from "./fields/upload";
import fieldTextAreaTiny from "./fields/textarea_tiny.vue";
import fieldTypography from "./fields/typo";
import fieldBG from "./fields/background";
import fieldListItem from "./fields/listitem";
import fieldRadioimage from "./fields/radio_image.vue";
import fieldCss from "./fields/editor_css.vue";
import fieldEmailTemplateDocument from  "./fields/email_template_doc.vue";
import fieldMappingCurrency from "./fields/mapping_currency.vue";
import fieldCustomText from "./fields/custom_text.vue";
import fieldCustomSelect from "./fields/custom_select.vue";
import fieldGooglefonts from "./fields/google-fonts.vue";

Vue.component("fieldOnOff", fieldOnOff);
Vue.component("fieldSwitchNew", fieldSwitch);
Vue.component("fieldTextNew", fieldText);
Vue.component("fieldTextAreaNew", fieldTextArea);
Vue.component("fieldSelectNew", fieldSelect);

Vue.component("fieldStUpload", fieldUpload);
Vue.component("fieldPostSelectAjax", fieldPostSelectAjax);
Vue.component("fieldTextAreaTiny", fieldTextAreaTiny);
Vue.component("fieldTypography", fieldTypography);
Vue.component("fieldBackground", fieldBG);
Vue.component("fieldListItem", fieldListItem);
Vue.component("fieldRadioimage", fieldRadioimage);
Vue.component("fieldCss", fieldCss);
Vue.component("fieldEmailTemplateDocument", fieldEmailTemplateDocument);
Vue.component("fieldMappingCurrency", fieldMappingCurrency);
Vue.component("fieldCustomText", fieldCustomText);
Vue.component("fieldCustomSelect", fieldCustomSelect);
Vue.component("fieldGooglefonts", fieldGooglefonts);

Vue.use(VueFormGenerator);