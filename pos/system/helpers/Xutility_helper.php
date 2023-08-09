<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');
if(!function_exists('notification'))
{

    function notification($message)
    {
        $_SESSION['notification'] = $message;
    }

}
if(!function_exists('isHTTPS'))
{

    function isHTTPS()
    {
        if(isset($_SERVER['HTTPS']))
        {
            return strtolower($_SERVER['HTTPS']) == 'on';
        }
        return false;
    }

}
if(!function_exists('isPostBack'))
{
    function isPostBack()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}

if(!function_exists('message'))
{

    function message($message)
    {
        $_SESSION['message'] = $message;
    }

}

if(!function_exists('exception'))
{

    function exception($message)
    {
        $_SESSION['exception'] = $message;
    }

}


if(!function_exists('dumpVar'))
{
    function dumpVar($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();
    }
}

if(!function_exists('get_country_states'))
{

    function get_country_states($country_id = '')
    {

        if($country_id == 'US')
        {
            return array("AL" => "Alabama",
                "AK" => "Alaska",
                "AZ" => "Arizona",
                "AR" => "Arkansas",
                "CA" => "California",
                "CO" => "Colorado",
                "CT" => "Connecticut",
                "DC" => "District of Columbia",
                "DE" => "Delaware",
                "FL" => "Florida",
                "GA" => "Georgia",
                "HI" => "Hawaii",
                "ID" => "Idaho",
                "IL" => "Illinois",
                "IN" => "Indiana",
                "IA" => "Iowa",
                "KS" => "Kansas",
                "KY" => "Kentucky",
                "LA" => "Louisiana",
                "ME" => "Maine",
                "MD" => "Maryland",
                "MA" => "Massachusetts",
                "MI" => "Michigan",
                "MN" => "Minnesota",
                "MS" => "Mississippi",
                "MO" => "Missouri",
                "MT" => "Montana",
                "NE" => "Nebraska",
                "NV" => "Nevada",
                "NH" => "New Hampshire",
                "NJ" => "New Jersey",
                "NM" => "New Mexico",
                "NY" => "New York",
                "NC" => "North Carolina",
                "ND" => "North Dakota",
                "OH" => "Ohio",
                "OK" => "Oklahoma",
                "OR" => "Oregon",
                "PA" => "Pennsylvania",
                "RI" => "Rhode Island",
                "SC" => "South Carolina",
                "SD" => "South Dakota",
                "TN" => "Tennessee",
                "TX" => "Texas",
                "UT" => "Utah",
                "VT" => "Vermont",
                "VA" => "Virginia",
                "WA" => "Washington",
                "WV" => "West Virginia",
                "WI" => "Wisconsin",
                "WY" => "Wyoming");
        }
        if($country_id == 'AU')
        {
            return array("ACT" => "ACT",
                "NSW" => "NSW",
                "NTX" => "NTX",
                "QLD" => "QLD",
                "SA" => "SA",
                "TAS" => "TAS",
                "VIC" => "VIC",
                "WAX" => "WAX");
        }
        if($country_id == 'CA')
        {
            return array("ALB" => "Alberta",
                "BC" => "British Columbia",
                "MTB" => "Manitoba",
                "NB" => "New Brunswick",
                "NF" => "Newfoundland",
                "NT" => "Northwest Territory",
                "NS" => "Nova Scotia",
                "NU" => "Nunavut",
                "ON" => "Ontario",
                "PE" => "Prince Edward Island",
                "QB" => "Quebec",
                "SW" => "Saskatchewan",
                "YU" => "Yukon");
        }
        if($country_id == '')
        {
            return array();
        }
    }

}

if(!function_exists('getCountryList'))
{

    function getCountryList()
    {
        return array('US' => 'United States',
            'GB' => 'United Kingdom',
            'CA' => 'Canada',
            'AU' => 'Australia',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua And Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia And Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo ; The Dem. Rep. Of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'TP' => 'East Timor',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island And Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IE' => 'Ireland',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JO' => 'Jordan',
            'KZ' => 'Kazakstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macau',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia; Federated States Of',
            'MD' => 'Moldova; Republic Of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory; Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts And Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre And Miquelon',
            'VC' => 'Saint Vincent And The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome And Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'SC' => 'Seychelles',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia / South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard And Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania; United Republic Of',
            'TH' => 'Thailand',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad And Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks And Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands; British',
            'VI' => 'Virgin Islands; U.S.',
            'WF' => 'Wallis And Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'YU' => 'Yugoslavia',
            'ZM' => 'Zambia'
        );
    }

}
if(!function_exists('getCountryFullName'))
{

    function getCountryFullName($abbr)
    {
        if(strlen($abbr) == 2)
        {
            $countries = getCountryList();

            return isset($countries[$abbr]) ? $countries[$abbr] : '';
        }
        return $abbr;
    }

}

//if(!function_exists('is_admin_loggedin'))
//{
//
//    function is_admin_loggedin()
//    {
//        if($_SESSION['is_admin_loggedin'] == '1')
//        {
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }
//}


if(!function_exists('get_admin_id'))
{

    function get_admin_id()
    {
        if(isset($_SESSION['admin_id']))
        {
            return $_SESSION['admin_id'];
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('admin_privilege'))
{

    function admin_privilege()
    {
        if(isset($_SESSION['admin_privilege']))
        {
            return $_SESSION['admin_privilege'];
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('is_member_loggedin'))
{

    function is_member_loggedin()
    {
        if($_SESSION['is_superadmin'] == '3')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('get_members_id'))
{
    function get_members_id()
    {
        if(isset($_SESSION['members_id']))
        {
            return $_SESSION['members_id'];
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('get_members_username'))
{
    function get_members_username()
    {
        if(isset($_SESSION['username']))
        {
            return $_SESSION['username'];
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('get_privilege_admin'))
{
    function get_privilege_admin()
    {
        if(isset($_SESSION['privilege_admin']))
        {
            return $_SESSION['privilege_admin'];
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('isLoggedin'))
{
    function isLoggedin()
    {
        if(isset($_SESSION['is_member_loggedin']))
        {
            return true;
        }
        else
        {
            redirect(BASEURL); exit;
        }
    }
}

if(!function_exists('checkLoggedin'))
{
    function checkLoggedin()
    {
        if(isset($_SESSION['is_member_loggedin']))
        {
            return true;
        }
        else
        {
            return false; 
        }
    }
}

if(!function_exists('get_product_count_by_manufacture_id'))
{
    function get_product_count_by_manufacture_id($manufacturer_id)
    {
        $sql = "SELECT COUNT(food_id) as total_rows
                FROM jajaka_food
                WHERE manufacturer_id = $manufacturer_id";
        $total_product = row_array($sql);
        if($total_product)
        {
            return $total_product['total_rows'];
        }
        return 0;
    }
}

if(!function_exists('advanced_search_query_list'))
{
    function advanced_search_query_list()
    {
        $sql = "SELECT DISTINCT p.product_name as search_item FROM jajaka_food p WHERE p.status = 1
                UNION 
                SELECT fcd.name as search_item FROM jajaka_food_category_description fcd 
                INNER JOIN jajaka_food_category fc ON fc.food_category_id = fcd.food_category_id AND fc.status = 1
                UNION 
                SELECT m.name as search_item FROM jajaka_food_manufacturer m WHERE m.status = 1";
        $result  = result_array($sql);
        if($result)
        {
            foreach($result as $rlt)
            {
                if (!in_array($rlt['search_item'], $resArr)) 
                {
                    $resArr[] = addslashes($rlt['search_item']); 
                } 
            }
            if($resArr)
            {
                foreach($resArr as $arr)
                {
                    $mList_arr[] = "'$arr'"; 
                }
                if($mList_arr)
                {
                    $comma_separated_items = implode(',',$mList_arr);
                }
                return $comma_separated_items; 
            }
            else
            {
                return "'NONE'";
            }
        }
        else
        {
            return 'NONE';
        }
    }
}

if(!function_exists('get_admin_privilege'))
{
    function get_admin_privilege($adminType,$privilege)
    {
        if($adminType=="SUPER_ADMIN")
        {
            return true;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="change_delete_picture")
        {
            return false;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="change_text_DirSubcatManu")
        {
            return false;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="create_SUPER_MODERATOR")
        {
            return false;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="create_MODERATOR")
        {
            return true;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="create_FAQ")
        {
            return true;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="create_AboutUs")
        {
            return true;
        }
        else if($adminType=="SUPER_MODERATOR" && $privilege=="create_edit_faq")
        {
            return true;
        }
        else if($adminType=="MODERATOR" && $privilege=="delete_products")
        {
            return true;
        }
        else if($adminType=="MODERATOR" && $privilege=="delete_comments")
        {
            return true;
        }
        else if($adminType=="MODERATOR" && $privilege=="delete_comments")
        {
            return true;
        }
        else if($adminType=="MODERATOR" && $privilege=="delete_topics_discussion")
        {
            return true;
        }
        else if($adminType=="MODERATOR" && $privilege=="ban_unban_users")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('get_nav_query'))
{
    function get_nav_query($sLimit,$eLimit)
    {
        $sql = "SELECT fc.food_category_id,
                       fc.image,
                       fc.parent_id,
                       fc.status,
                       fcd.name
                FROM jajaka_food_category fc
                INNER JOIN jajaka_food_category_description fcd ON fcd.food_category_id = fc.food_category_id
                WHERE fc.parent_id = 0
                AND fc.status = 1
                ORDER BY fcd.name ASC
                LIMIT $sLimit,$eLimit";
        return $sql;
    }
}

if(!function_exists('get_master_category_product_cnt'))
{
    function get_master_category_product_cnt($food_category_id)
    {
        $sql = "SELECT food_category_id FROM jajaka_food_category WHERE parent_id = $food_category_id";
        $result = result_array($sql);
        if($result)
        {
             foreach($result as $rslt)
             {
                $resultArr[] = $rslt['food_category_id'];
             }
             if($resultArr)
             {
                 $food_category_ids = implode(',',$resultArr);
             }
        }  
        $sql = "SELECT COUNT(food_id) FROM jajaka_food WHERE food_category_id IN ( $food_category_ids)";
        $result = row_array($sql);
        if($result)
        {
//            foreach($result as $res)
//            {
//                $resArr[] = $res['food_category_id'];
//            }
//            $comma_seperated_food_category_ids = implode(',',$resArr);
//            $sql = "SELECT COUNT(food_id) as total_rows FROM jajaka_food WHERE food_category_id IN($comma_seperated_food_category_ids) LIMIT 1";
//            $totalArr = row_array($sql);
//            if($totalArr)
//            {
//               return $totalArr['total_rows'];
//            }
            return $result['COUNT(food_id)'];
        }
        return 0;
    }
}
if(!function_exists('sub_category_name_list'))
{
    function sub_category_name_list($food_category_id)
    {
        $sql = "SELECT fc.food_category_id,
                       fcd.name
                FROM jajaka_food_category fc
                INNER JOIN jajaka_food_category_description fcd ON fcd.food_category_id = fc.food_category_id
                WHERE fc.parent_id = $food_category_id
                AND fc.status = 1";
        $result = result_array($sql);
        if($result)
        {
           foreach($result as $res)
           {
                $resArr[] = $res['name'];
           }
           $comma_seperated_food_category_names = implode(',',$resArr);  
           return $comma_seperated_food_category_names;
        }
        return '';
    }
} 

if(!function_exists('is_user_loged_in'))
{
    function is_user_loged_in()
    {
        if( $_SESSION['is_member_loggedin']==1)
            return true;
        else
            return false;  
    }
}
if(!function_exists('result_array'))
{
    function result_array($sql)
    {
        $result = array(); 
        $query = mysql_query($sql);
        while($data = mysql_fetch_array($query))
        {
            $result[] =  $data;
        }
        $rows = count($result);
        if($rows)
        {
            $total_global_rows = count($result);
            $total_inner_rows =  count($result[0]);
            $count_total_inner_rows = $total_inner_rows/2;

            for($i = 0;$i<$total_global_rows;$i++)
            {
                for($j=0;$j<$count_total_inner_rows;$j++)
                {
                    unset($result[$i][$j]);        
                }    
            }
        }    
        return $result;    
    }
}
if(!function_exists('row_array')) 
{
    function row_array($sql)
    {
        $result = array(); 
        $query = mysql_query($sql);
        $data = mysql_fetch_assoc($query);    
        return $data;
    }
}

if(!function_exists('toottip_product_name_list')) 
{
    function toottip_product_name_list($food_category_id)
    {
        $sql = "SELECT f.food_id,
                       f.food_category_id,
                       f.product_name,
                       fm.manufacturer_id
                FROM jajaka_food f
                INNER JOIN jajaka_food_manufacturer fm  ON fm.manufacturer_id = f.manufacturer_id
                WHERE f.status = 1
                AND fm.status = 1
                AND f.food_category_id = $food_category_id
                ORDER BY f.product_name ASC";
        $pRes = result_array($sql);
        $pTotal = count($pRes);
        if($pRes)
        {
           $pCnt = 0;
           foreach($pRes as $p)
           {
               $pCnt++;
               $pArr[] = stripcslashes($p['product_name']);
               if($pCnt == 10)
               {
                  break; 
               }
           }
           if($pTotal>10)
           {
              $pArr[] = '<a href="'.BASEURL.'product/'.$food_category_id.'/more">More</a>';
           }
           if($pArr)
           {
               $implode_product = implode('<br/>',$pArr);
           }
        }
        else
        {
           $implode_product = 'No Product';
        }
        $returnArr['implode_product'] = $implode_product;
        $returnArr['total_products'] = $pTotal;
        
        return $returnArr; 
    }
}
if(!function_exists('tooltip_manufacture_list')) 
{
    function tooltip_manufacture_list($food_category_id)
    {
        $sql = "SELECT DISTINCT f.manufacturer_id
                FROM jajaka_food f
                INNER JOIN jajaka_food_manufacturer fm  ON fm.manufacturer_id = f.manufacturer_id
                WHERE f.status = 1
                AND fm.status = 1
                AND f.food_category_id = $food_category_id";
        $mList = result_array($sql); 
        
       
        if($mList)
        {
           foreach($mList as $m)
           {
               $mArr[] = $m['manufacturer_id']; 
           }
           if($mArr)
           {
              $comma_manufacture_ids = implode(',',$mArr);
              
              unset($mArr);
              
              $sql = "SELECT manufacturer_id,
                             name
                      FROM jajaka_food_manufacturer 
                      WHERE manufacturer_id IN($comma_manufacture_ids)";
              $mData = result_array($sql); 
              $mTotal = count($mData); 
              if($mData)
              {
                   $mCnt = 0;
                   foreach($mData as $m)
                   {
                       $mCnt++;
                       $mArr[] = stripcslashes($m['name']);
                       if($mCnt == 10)
                       {
                          break; 
                       }
                   }
                   if($mTotal>10)
                   {
                      $mArr[] = '<a href="'.BASEURL.'manufacture/'.$food_category_id.'/'.$m['manufacturer_id'].'/more">More</a>';
                   }
                   if($mArr)
                   {
                       $implode_manufacture = implode('<br/>',$mArr);
                   }
                   else
                   {
                        $implode_manufacture = 'No Manufacture'; 
                   } 
              }
              else
              {
                $implode_manufacture = 'No Manufacture'; 
              } 
           }
        }
        else
        {
            $implode_manufacture = 'No Manufacture'; 
        }
        $returnArr['implode_manufacture'] = $implode_manufacture;
        $returnArr['total_manufacture'] = $mTotal;
        
        return $returnArr; 
    }
}
if(!function_exists('get_category_image')) 
{
    function get_category_image($image)
    {
        if($r['image'] && file_exists('../images/food_category/'.$image))
        {
            $img = 'images/food_category/thumb/'.$image;
        }
        else
        {
            $img = 'images/no_image.png'; 
        }
        return $img;
    }
}
if(!function_exists('get_category_product_cnt')) 
{
    function get_category_product_cnt($food_category_id)
    {
        $sql = "SELECT COUNT(food_id) as total_product FROM jajaka_food WHERE food_category_id = $food_category_id AND status = 1 LIMIT 1";
        $res = row_array($sql);
        if($res)
        {
           return $res['total_product']; 
        }
        else
        {
           return 0;  
        }
    }
}


if(!function_exists('get_total_comment_count')) 
{
    function get_total_comment_count($parent_discussion_id)
    {
        $sql = "SELECT COUNT(discussion_id) as total_rows FROM jajaka_discussion WHERE parent_discussion_id = $parent_discussion_id AND status = 1 LIMIT 1";
        $res = row_array($sql);
        if($res)
        {
           return $res['total_rows']; 
        }
        else
        {
           return 0;  
        }
    }
}

if(!function_exists('get_food_total_comment_count')) 
{
    function get_food_total_comment_count($parent_food_discussion_id)
    {
        $sql = "SELECT COUNT(food_discussion_id) as total_rows FROM jajaka_food_discussion WHERE parent_food_discussion_id = $parent_food_discussion_id AND status = 1 LIMIT 1";
        $res = row_array($sql);
        if($res)
        {
           return $res['total_rows']; 
        }
        else
        {
           return 0;  
        }
    }
}

if(!function_exists('time_since'))
{
    function time_since($original)
    {
        $chunks = array(
            array(60 * 60 * 24 * 365, 'year'),
            array(60 * 60 * 24 * 30, 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24, 'day'),
            array(60 * 60, 'hour'),
            array(60, 'minute'),
        );
        $today = time(); /* Current unix time  */
        $since = $today - $original;
        // $j saves performing the count function each time around the loop
        for($i = 0, $j = count($chunks); $i < $j; $i++)
        {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            // finding the biggest chunk (if the chunk fits, break)
            if(($count = floor($since / $seconds)) != 0)
            {
                // DEBUG print "<!-- It's $name -->\n";
                break;
            }
        }
        $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";
        if($i + 1 < $j)
        {
            // now getting the second item
            $seconds2 = $chunks[$i + 1][0];
            $name2 = $chunks[$i + 1][1];

            // add second item if it's greater than 0
            if(($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
            {
                $print .= ($count2 == 1) ? ', 1 ' . $name2 : ", $count2 {$name2}s";
            }
        }
        return $print;
    }
}

if(!function_exists('is_aboused_by_member')) 
{
    function is_aboused_by_member($discussion_id,$members_id)
    {
        $sql = "SELECT abouse_discussion_id FROM jajaka_abouse_discussion WHERE discussion_id = $discussion_id AND aboused_by_members_id = $members_id AND abouse_count >= 10 LIMIT 1";
        $res = row_array($sql);
        
        if($res)
        {
           return true; 
        }
        else
        {
           return false;   
        }
    }
}

if(!function_exists('is_food_aboused_by_member')) 
{
    function is_food_aboused_by_member($food_discussion_id,$members_id)
    {
        $sql = "SELECT food_abouse_discussion_id FROM jajaka_food_abouse_discussion WHERE food_discussion_id = $food_discussion_id AND aboused_by_members_id = $members_id LIMIT 1";
        $res = row_array($sql);
        if($res)
        {
           return true; 
        }
        else
        {
           return false;   
        }
    }
}

if(!function_exists('is_given_vote'))
{
    function is_given_vote($discussion_id,$members_id,$vote)
    {
        $sql = "SELECT discussion_vote_id FROM jajaka_discussion_vote WHERE discussion_id = $discussion_id AND vote_by_members_id = $members_id AND vote = $vote LIMIT 1";
        $res = row_array($sql);
        
        if($res)
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('is_food_given_vote'))
{
    function is_food_given_vote($food_discussion_id,$members_id,$vote)
    {
        $sql = "SELECT food_discussion_vote_id FROM jajaka_food_discussion_vote WHERE food_discussion_id = $food_discussion_id AND vote_by_members_id = $members_id AND vote = $vote LIMIT 1";
        $res = row_array($sql);
        
        if($res)
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('is_given_food_vote_by_member'))
{
    function is_given_food_vote_by_member($members_id,$food_id,$vote)
    {
        $sql = "SELECT food_user_vote_id FROM jajaka_food_user_vote WHERE food_id = $food_id AND members_id = $members_id AND vote = $vote AND status = 1 LIMIT 1";
        $res = row_array($sql);
        
        if($res)
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('is_given_food_vote_by_session_member'))
{
    function is_given_food_vote_by_session_member($food_id,$vote)
    {
        $session_id = session_id();
        $sql = "SELECT food_user_vote_id FROM jajaka_food_user_vote WHERE food_id = $food_id AND session_id = $session_id AND vote = $vote AND status = 1 LIMIT 1";
        $res = row_array($sql);
        if($res)
        {
            return true;
        }
        return false;
    }
}


if(!function_exists('total_food_item_vote'))
{
    function total_food_item_vote($food_id,$user_type=0,$vote)
    {
        if($user_type == '1')
        {
           $con = " AND members_id > 0"; 
        }
        else
        {
           $con = " AND members_id = 0";  
        }
        $sql = "SELECT COUNT(food_user_vote_id) as total_votes FROM jajaka_food_user_vote WHERE food_id = $food_id AND status = 1 $con AND vote = $vote";
        $res = row_array($sql);
        if($res)
        {
            return $res['total_votes'];
        }
        return 0;
    }
}

if(!function_exists('get_vote_in_percent'))
{
    function get_vote_in_percent($food_id,$user_type=0)
    {
        if($user_type == '1')
        {
           $con = " AND members_id > 0"; 
        }
        else
        {
           $con = " AND members_id = 0";  
        }
        $sql = "SELECT vote FROM jajaka_food_user_vote WHERE food_id = $food_id AND status = 1 $con";
        $res = result_array($sql);
        
        $upvCnt = 0;
        $dnvCnt = 0;
        
        if($res)
        {
            foreach($res as $rs)
            {
               if($rs['vote'] == '1')
               {
                  $upvCnt = $upvCnt+1;
               }
               else
               {
                  $dnvCnt = $dnvCnt+1;
               } 
            }
            $total_vote = $upvCnt + $dnvCnt;
            $upvote_percent = ((100*$upvCnt)/$total_vote);
            return $upvote_percent;
            
        }
        return 0;
    }
}

if(!function_exists('total_comments'))
{
    function total_comments($food_id)
    {
       $sql = "SELECT COUNT(food_discussion_id) as total_comments FROM jajaka_food_discussion WHERE food_id = $food_id AND parent_food_discussion_id = 0 AND status = 1 LIMIT 1"; 
       $res = row_array($sql);
       if($res)
       {
           return $res['total_comments'];
       }
       else
       {
           return 0;
       }
    }
}

if(!function_exists('user_avater'))
{
    function user_avater($members_id)
    {
       $sql = "SELECT member_image FROM jajaka_members WHERE members_id = $members_id LIMIT 1"; 
       $res = row_array($sql);
       if($res)
       {
           return $res['member_image'];
       }
       else
       {
           return '';
       }
    }
}

if(!function_exists('get_members_avater'))
{
    function get_members_avater($members_id,$large = 0)
    {
        $sql = "SELECT member_image,fbid,google_user_id FROM jajaka_members WHERE members_id = $members_id LIMIT 1"; 
        $res = row_array($sql); 
        
        if($res)
        {
           if($res['member_image'] && stripos($res['member_image'], "http") != true)
           {
               if($large == 1)
               {
                   return BASEURL.'images/profile_image/'.$res['member_image'];   
               }
               else
               {
                   return $res['member_image'];   
               }
               
           }
           else if($res['member_image'] && stripos($res['member_image'], "http") == true)
           {
               return $res['member_image']; 
           }
           else if(!$res['member_image'])
           {
               if($res['fbid'])
               {
                   if($large == 1)
                   {
                       return 'https://graph.facebook.com/'.$res['fbid'].'/picture?type=large';   
                   }
                   else
                   {
                       return 'https://graph.facebook.com/'.$res['fbid'].'/picture?type=large';   
                   }
               }
               else
               {
                  return BASEURL.'no_image_avater.png';    
               }
           }
        }
    }
}
?>