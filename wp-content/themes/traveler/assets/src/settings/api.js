import axios from "axios"
import qs from "querystring"

export default {
    getSchema(section)
    {
        let data={
            'action':'traveler.settings.section_schema',
            _s:traveler_settings._s,
            section:section
        };
        return axios.post(traveler_settings.ajax_url,qs.stringify(data),{
            headers:{
                'content-type':'application/x-www-form-urlencoded'
            }
        });
    },
    saveSettings(model){
        let data={
            'action':'traveler.settings.save',
            _s:traveler_settings._s,
            settings:JSON.stringify(model)
        };
        return axios.post(traveler_settings.ajax_url,qs.stringify(data),{
            headers:{
                'content-type':'application/x-www-form-urlencoded'
            }
        });
    },
    postSelectAjax(q,post_type, sparam){
        let data={
            'action':'traveler.settings.post_select',
            _s:traveler_settings._s,
            q:q,
            post_type:post_type,
            sparam: sparam
        };
        return axios.post(traveler_settings.ajax_url,qs.stringify(data),{
            headers:{
                'content-type':'application/x-www-form-urlencoded'
            }
        });
    },
    getEmailDocument(){
        let data={
            'action':'traveler.settings.email_document',
        };
        return axios.post(traveler_settings.ajax_url,qs.stringify(data),{
            headers:{
                'content-type':'application/x-www-form-urlencoded'
            }
        });
    },
}