<?php


namespace HelloCash\HelloMicroservice\GraphQL\EnumTypes;


use GraphQL\Type\Definition\EnumType;

class Countries extends BaseEnum
{

    /**
     * @return EnumType
     */
    public static function get(): EnumType
    {
        return new EnumType([
            'name' => 'CountryCode',
            'description' => 'ISO 3166-1 alpha-2',
            'values' => [
                'AD' => [
                    'value' => 'AD',
                    'description' => 'Andorra'
                ],
                'AE' => [
                    'value' => 'AE',
                    'description' => 'United Arab Emirates'
                ],
                'AF' => [
                    'value' => 'AF',
                    'description' => 'Afghanistan'
                ],
                'AG' => [
                    'value' => 'AG',
                    'description' => 'Antigua and Barbuda'
                ],
                'AI' => [
                    'value' => 'AI',
                    'description' => 'Anguilla'
                ],
                'AL' => [
                    'value' => 'AL',
                    'description' => 'Albania'
                ],
                'AM' => [
                    'value' => 'AM',
                    'description' => 'Armenia'
                ],
                'AO' => [
                    'value' => 'AO',
                    'description' => 'Angola'
                ],
                'AQ' => [
                    'value' => 'AQ',
                    'description' => 'Antarctica'
                ],
                'AR' => [
                    'value' => 'AR',
                    'description' => 'Argentina'
                ],
                'AS' => [
                    'value' => 'AS',
                    'description' => 'American Samoa'
                ],
                'AT' => [
                    'value' => 'AT',
                    'description' => 'Austria'
                ],
                'AU' => [
                    'value' => 'AU',
                    'description' => 'Australia'
                ],
                'AW' => [
                    'value' => 'AW',
                    'description' => 'Aruba'
                ],
                'AX' => [
                    'value' => 'AX',
                    'description' => 'Åland Islands'
                ],
                'AZ' => [
                    'value' => 'AZ',
                    'description' => 'Azerbaijan'
                ],
                'BA' => [
                    'value' => 'BA',
                    'description' => 'Bosnia and Herzegovina'
                ],
                'BB' => [
                    'value' => 'BB',
                    'description' => 'Barbados'
                ],
                'BD' => [
                    'value' => 'BD',
                    'description' => 'Bangladesh'
                ],
                'BE' => [
                    'value' => 'BE',
                    'description' => 'Belgium'
                ],
                'BF' => [
                    'value' => 'BF',
                    'description' => 'Burkina Faso'
                ],
                'BG' => [
                    'value' => 'BG',
                    'description' => 'Bulgaria'
                ],
                'BH' => [
                    'value' => 'BH',
                    'description' => 'Bahrain'
                ],
                'BI' => [
                    'value' => 'BI',
                    'description' => 'Burundi'
                ],
                'BJ' => [
                    'value' => 'BJ',
                    'description' => 'Benin'
                ],
                'BL' => [
                    'value' => 'BL',
                    'description' => 'Saint Barthélemy'
                ],
                'BM' => [
                    'value' => 'BM',
                    'description' => 'Bermuda'
                ],
                'BN' => [
                    'value' => 'BN',
                    'description' => 'Brunei Darussalam'
                ],
                'BO' => [
                    'value' => 'BO',
                    'description' => 'Bolivia (Plurinational State of)'
                ],
                'BQ' => [
                    'value' => 'BQ',
                    'description' => 'Bonaire, Sint Eustatius and Saba'
                ],
                'BR' => [
                    'value' => 'BR',
                    'description' => 'Brazil'
                ],
                'BS' => [
                    'value' => 'BS',
                    'description' => 'Bahamas'
                ],
                'BT' => [
                    'value' => 'BT',
                    'description' => 'Bhutan'
                ],
                'BV' => [
                    'value' => 'BV',
                    'description' => 'Bouvet Island'
                ],
                'BW' => [
                    'value' => 'BW',
                    'description' => 'Botswana'
                ],
                'BY' => [
                    'value' => 'BY',
                    'description' => 'Belarus'
                ],
                'BZ' => [
                    'value' => 'BZ',
                    'description' => 'Belize'
                ],
                'CA' => [
                    'value' => 'CA',
                    'description' => 'Canada'
                ],
                'CC' => [
                    'value' => 'CC',
                    'description' => 'Cocos (Keeling) Islands'
                ],
                'CD' => [
                    'value' => 'CD',
                    'description' => 'Congo, Democratic Republic of the'
                ],
                'CF' => [
                    'value' => 'CF',
                    'description' => 'Central African Republic'
                ],
                'CG' => [
                    'value' => 'CG',
                    'description' => 'Congo'
                ],
                'CH' => [
                    'value' => 'CH',
                    'description' => 'Switzerland'
                ],
                'CI' => [
                    'value' => 'CI',
                    'description' => 'Côte d\'Ivoire'
                ],
                'CK' => [
                    'value' => 'CK',
                    'description' => 'Cook Islands'
                ],
                'CL' => [
                    'value' => 'CL',
                    'description' => 'Chile'
                ],
                'CM' => [
                    'value' => 'CM',
                    'description' => 'Cameroon'
                ],
                'CN' => [
                    'value' => 'CN',
                    'description' => 'China'
                ],
                'CO' => [
                    'value' => 'CO',
                    'description' => 'Colombia'
                ],
                'CR' => [
                    'value' => 'CR',
                    'description' => 'Costa Rica'
                ],
                'CU' => [
                    'value' => 'CU',
                    'description' => 'Cuba'
                ],
                'CV' => [
                    'value' => 'CV',
                    'description' => 'Cabo Verde'
                ],
                'CW' => [
                    'value' => 'CW',
                    'description' => 'Curaçao'
                ],
                'CX' => [
                    'value' => 'CX',
                    'description' => 'Christmas Island'
                ],
                'CY' => [
                    'value' => 'CY',
                    'description' => 'Cyprus'
                ],
                'CZ' => [
                    'value' => 'CZ',
                    'description' => 'Czechia'
                ],
                'DE' => [
                    'value' => 'DE',
                    'description' => 'Germany'
                ],
                'DJ' => [
                    'value' => 'DJ',
                    'description' => 'Djibouti'
                ],
                'DK' => [
                    'value' => 'DK',
                    'description' => 'Denmark'
                ],
                'DM' => [
                    'value' => 'DM',
                    'description' => 'Dominica'
                ],
                'DO' => [
                    'value' => 'DO',
                    'description' => 'Dominican Republic'
                ],
                'DZ' => [
                    'value' => 'DZ',
                    'description' => 'Algeria'
                ],
                'EC' => [
                    'value' => 'EC',
                    'description' => 'Ecuador'
                ],
                'EE' => [
                    'value' => 'EE',
                    'description' => 'Estonia'
                ],
                'EG' => [
                    'value' => 'EG',
                    'description' => 'Egypt'
                ],
                'EH' => [
                    'value' => 'EH',
                    'description' => 'Western Sahara'
                ],
                'ER' => [
                    'value' => 'ER',
                    'description' => 'Eritrea'
                ],
                'ES' => [
                    'value' => 'ES',
                    'description' => 'Spain'
                ],
                'ET' => [
                    'value' => 'ET',
                    'description' => 'Ethiopia'
                ],
                'FI' => [
                    'value' => 'FI',
                    'description' => 'Finland'
                ],
                'FJ' => [
                    'value' => 'FJ',
                    'description' => 'Fiji'
                ],
                'FK' => [
                    'value' => 'FK',
                    'description' => 'Falkland Islands (Malvinas)'
                ],
                'FM' => [
                    'value' => 'FM',
                    'description' => 'Micronesia (Federated States of)'
                ],
                'FO' => [
                    'value' => 'FO',
                    'description' => 'Faroe Islands'
                ],
                'FR' => [
                    'value' => 'FR',
                    'description' => 'France'
                ],
                'GA' => [
                    'value' => 'GA',
                    'description' => 'Gabon'
                ],
                'GB' => [
                    'value' => 'GB',
                    'description' => 'United Kingdom of Great Britain and Northern Ireland'
                ],
                'GD' => [
                    'value' => 'GD',
                    'description' => 'Grenada'
                ],
                'GE' => [
                    'value' => 'GE',
                    'description' => 'Georgia'
                ],
                'GF' => [
                    'value' => 'GF',
                    'description' => 'French Guiana'
                ],
                'GG' => [
                    'value' => 'GG',
                    'description' => 'Guernsey'
                ],
                'GH' => [
                    'value' => 'GH',
                    'description' => 'Ghana'
                ],
                'GI' => [
                    'value' => 'GI',
                    'description' => 'Gibraltar'
                ],
                'GL' => [
                    'value' => 'GL',
                    'description' => 'Greenland'
                ],
                'GM' => [
                    'value' => 'GM',
                    'description' => 'Gambia'
                ],
                'GN' => [
                    'value' => 'GN',
                    'description' => 'Guinea'
                ],
                'GP' => [
                    'value' => 'GP',
                    'description' => 'Guadeloupe'
                ],
                'GQ' => [
                    'value' => 'GQ',
                    'description' => 'Equatorial Guinea'
                ],
                'GR' => [
                    'value' => 'GR',
                    'description' => 'Greece'
                ],
                'GS' => [
                    'value' => 'GS',
                    'description' => 'South Georgia and the South Sandwich Islands'
                ],
                'GT' => [
                    'value' => 'GT',
                    'description' => 'Guatemala'
                ],
                'GU' => [
                    'value' => 'GU',
                    'description' => 'Guam'
                ],
                'GW' => [
                    'value' => 'GW',
                    'description' => 'Guinea-Bissau'
                ],
                'GY' => [
                    'value' => 'GY',
                    'description' => 'Guyana'
                ],
                'HK' => [
                    'value' => 'HK',
                    'description' => 'Hong Kong'
                ],
                'HM' => [
                    'value' => 'HM',
                    'description' => 'Heard Island and McDonald Islands'
                ],
                'HN' => [
                    'value' => 'HN',
                    'description' => 'Honduras'
                ],
                'HR' => [
                    'value' => 'HR',
                    'description' => 'Croatia'
                ],
                'HT' => [
                    'value' => 'HT',
                    'description' => 'Haiti'
                ],
                'HU' => [
                    'value' => 'HU',
                    'description' => 'Hungary'
                ],
                'ID' => [
                    'value' => 'ID',
                    'description' => 'Indonesia'
                ],
                'IE' => [
                    'value' => 'IE',
                    'description' => 'Ireland'
                ],
                'IL' => [
                    'value' => 'IL',
                    'description' => 'Israel'
                ],
                'IM' => [
                    'value' => 'IM',
                    'description' => 'Isle of Man'
                ],
                'IN' => [
                    'value' => 'IN',
                    'description' => 'India'
                ],
                'IO' => [
                    'value' => 'IO',
                    'description' => 'British Indian Ocean Territory'
                ],
                'IQ' => [
                    'value' => 'IQ',
                    'description' => 'Iraq'
                ],
                'IR' => [
                    'value' => 'IR',
                    'description' => 'Iran (Islamic Republic of)'
                ],
                'IS' => [
                    'value' => 'IS',
                    'description' => 'Iceland'
                ],
                'IT' => [
                    'value' => 'IT',
                    'description' => 'Italy'
                ],
                'JE' => [
                    'value' => 'JE',
                    'description' => 'Jersey'
                ],
                'JM' => [
                    'value' => 'JM',
                    'description' => 'Jamaica'
                ],
                'JO' => [
                    'value' => 'JO',
                    'description' => 'Jordan'
                ],
                'JP' => [
                    'value' => 'JP',
                    'description' => 'Japan'
                ],
                'KE' => [
                    'value' => 'KE',
                    'description' => 'Kenya'
                ],
                'KG' => [
                    'value' => 'KG',
                    'description' => 'Kyrgyzstan'
                ],
                'KH' => [
                    'value' => 'KH',
                    'description' => 'Cambodia'
                ],
                'KI' => [
                    'value' => 'KI',
                    'description' => 'Kiribati'
                ],
                'KM' => [
                    'value' => 'KM',
                    'description' => 'Comoros'
                ],
                'KN' => [
                    'value' => 'KN',
                    'description' => 'Saint Kitts and Nevis'
                ],
                'KP' => [
                    'value' => 'KP',
                    'description' => 'Korea (Democratic People\'s Republic of)'
                ],
                'KR' => [
                    'value' => 'KR',
                    'description' => 'Korea, Republic of'
                ],
                'KW' => [
                    'value' => 'KW',
                    'description' => 'Kuwait'
                ],
                'KY' => [
                    'value' => 'KY',
                    'description' => 'Cayman Islands'
                ],
                'KZ' => [
                    'value' => 'KZ',
                    'description' => 'Kazakhstan'
                ],
                'LA' => [
                    'value' => 'LA',
                    'description' => 'Lao People\'s Democratic Republic'
                ],
                'LB' => [
                    'value' => 'LB',
                    'description' => 'Lebanon'
                ],
                'LC' => [
                    'value' => 'LC',
                    'description' => 'Saint Lucia'
                ],
                'LI' => [
                    'value' => 'LI',
                    'description' => 'Liechtenstein'
                ],
                'LK' => [
                    'value' => 'LK',
                    'description' => 'Sri Lanka'
                ],
                'LR' => [
                    'value' => 'LR',
                    'description' => 'Liberia'
                ],
                'LS' => [
                    'value' => 'LS',
                    'description' => 'Lesotho'
                ],
                'LT' => [
                    'value' => 'LT',
                    'description' => 'Lithuania'
                ],
                'LU' => [
                    'value' => 'LU',
                    'description' => 'Luxembourg'
                ],
                'LV' => [
                    'value' => 'LV',
                    'description' => 'Latvia'
                ],
                'LY' => [
                    'value' => 'LY',
                    'description' => 'Libya'
                ],
                'MA' => [
                    'value' => 'MA',
                    'description' => 'Morocco'
                ],
                'MC' => [
                    'value' => 'MC',
                    'description' => 'Monaco'
                ],
                'MD' => [
                    'value' => 'MD',
                    'description' => 'Moldova, Republic of'
                ],
                'ME' => [
                    'value' => 'ME',
                    'description' => 'Montenegro'
                ],
                'MF' => [
                    'value' => 'MF',
                    'description' => 'Saint Martin (French part)'
                ],
                'MG' => [
                    'value' => 'MG',
                    'description' => 'Madagascar'
                ],
                'MH' => [
                    'value' => 'MH',
                    'description' => 'Marshall Islands'
                ],
                'MK' => [
                    'value' => 'MK',
                    'description' => 'North Macedonia'
                ],
                'ML' => [
                    'value' => 'ML',
                    'description' => 'Mali'
                ],
                'MM' => [
                    'value' => 'MM',
                    'description' => 'Myanmar'
                ],
                'MN' => [
                    'value' => 'MN',
                    'description' => 'Mongolia'
                ],
                'MO' => [
                    'value' => 'MO',
                    'description' => 'Macao'
                ],
                'MP' => [
                    'value' => 'MP',
                    'description' => 'Northern Mariana Islands'
                ],
                'MQ' => [
                    'value' => 'MQ',
                    'description' => 'Martinique'
                ],
                'MR' => [
                    'value' => 'MR',
                    'description' => 'Mauritania'
                ],
                'MS' => [
                    'value' => 'MS',
                    'description' => 'Montserrat'
                ],
                'MT' => [
                    'value' => 'MT',
                    'description' => 'Malta'
                ],
                'MU' => [
                    'value' => 'MU',
                    'description' => 'Mauritius'
                ],
                'MV' => [
                    'value' => 'MV',
                    'description' => 'Maldives'
                ],
                'MW' => [
                    'value' => 'MW',
                    'description' => 'Malawi'
                ],
                'MX' => [
                    'value' => 'MX',
                    'description' => 'Mexico'
                ],
                'MY' => [
                    'value' => 'MY',
                    'description' => 'Malaysia'
                ],
                'MZ' => [
                    'value' => 'MZ',
                    'description' => 'Mozambique'
                ],
                'NA' => [
                    'value' => 'NA',
                    'description' => 'Namibia'
                ],
                'NC' => [
                    'value' => 'NC',
                    'description' => 'New Caledonia'
                ],
                'NE' => [
                    'value' => 'NE',
                    'description' => 'Niger'
                ],
                'NF' => [
                    'value' => 'NF',
                    'description' => 'Norfolk Island'
                ],
                'NG' => [
                    'value' => 'NG',
                    'description' => 'Nigeria'
                ],
                'NI' => [
                    'value' => 'NI',
                    'description' => 'Nicaragua'
                ],
                'NL' => [
                    'value' => 'NL',
                    'description' => 'Netherlands'
                ],
                'NO' => [
                    'value' => 'NO',
                    'description' => 'Norway'
                ],
                'NP' => [
                    'value' => 'NP',
                    'description' => 'Nepal'
                ],
                'NR' => [
                    'value' => 'NR',
                    'description' => 'Nauru'
                ],
                'NU' => [
                    'value' => 'NU',
                    'description' => 'Niue'
                ],
                'NZ' => [
                    'value' => 'NZ',
                    'description' => 'New Zealand'
                ],
                'OM' => [
                    'value' => 'OM',
                    'description' => 'Oman'
                ],
                'PA' => [
                    'value' => 'PA',
                    'description' => 'Panama'
                ],
                'PE' => [
                    'value' => 'PE',
                    'description' => 'Peru'
                ],
                'PF' => [
                    'value' => 'PF',
                    'description' => 'French Polynesia'
                ],
                'PG' => [
                    'value' => 'PG',
                    'description' => 'Papua New Guinea'
                ],
                'PH' => [
                    'value' => 'PH',
                    'description' => 'Philippines'
                ],
                'PK' => [
                    'value' => 'PK',
                    'description' => 'Pakistan'
                ],
                'PL' => [
                    'value' => 'PL',
                    'description' => 'Poland'
                ],
                'PM' => [
                    'value' => 'PM',
                    'description' => 'Saint Pierre and Miquelon'
                ],
                'PN' => [
                    'value' => 'PN',
                    'description' => 'Pitcairn'
                ],
                'PR' => [
                    'value' => 'PR',
                    'description' => 'Puerto Rico'
                ],
                'PS' => [
                    'value' => 'PS',
                    'description' => 'Palestine, State of'
                ],
                'PT' => [
                    'value' => 'PT',
                    'description' => 'Portugal'
                ],
                'PW' => [
                    'value' => 'PW',
                    'description' => 'Palau'
                ],
                'PY' => [
                    'value' => 'PY',
                    'description' => 'Paraguay'
                ],
                'QA' => [
                    'value' => 'QA',
                    'description' => 'Qatar'
                ],
                'RE' => [
                    'value' => 'RE',
                    'description' => 'Réunion'
                ],
                'RO' => [
                    'value' => 'RO',
                    'description' => 'Romania'
                ],
                'RS' => [
                    'value' => 'RS',
                    'description' => 'Serbia'
                ],
                'RU' => [
                    'value' => 'RU',
                    'description' => 'Russian Federation'
                ],
                'RW' => [
                    'value' => 'RW',
                    'description' => 'Rwanda'
                ],
                'SA' => [
                    'value' => 'SA',
                    'description' => 'Saudi Arabia'
                ],
                'SB' => [
                    'value' => 'SB',
                    'description' => 'Solomon Islands'
                ],
                'SC' => [
                    'value' => 'SC',
                    'description' => 'Seychelles'
                ],
                'SD' => [
                    'value' => 'SD',
                    'description' => 'Sudan'
                ],
                'SE' => [
                    'value' => 'SE',
                    'description' => 'Sweden'
                ],
                'SG' => [
                    'value' => 'SG',
                    'description' => 'Singapore'
                ],
                'SH' => [
                    'value' => 'SH',
                    'description' => 'Saint Helena, Ascension and Tristan da Cunha'
                ],
                'SI' => [
                    'value' => 'SI',
                    'description' => 'Slovenia'
                ],
                'SJ' => [
                    'value' => 'SJ',
                    'description' => 'Svalbard and Jan Mayen'
                ],
                'SK' => [
                    'value' => 'SK',
                    'description' => 'Slovakia'
                ],
                'SL' => [
                    'value' => 'SL',
                    'description' => 'Sierra Leone'
                ],
                'SM' => [
                    'value' => 'SM',
                    'description' => 'San Marino'
                ],
                'SN' => [
                    'value' => 'SN',
                    'description' => 'Senegal'
                ],
                'SO' => [
                    'value' => 'SO',
                    'description' => 'Somalia'
                ],
                'SR' => [
                    'value' => 'SR',
                    'description' => 'Suriname'
                ],
                'SS' => [
                    'value' => 'SS',
                    'description' => 'South Sudan'
                ],
                'ST' => [
                    'value' => 'ST',
                    'description' => 'Sao Tome and Principe'
                ],
                'SV' => [
                    'value' => 'SV',
                    'description' => 'El Salvador'
                ],
                'SX' => [
                    'value' => 'SX',
                    'description' => 'Sint Maarten (Dutch part)'
                ],
                'SY' => [
                    'value' => 'SY',
                    'description' => 'Syrian Arab Republic'
                ],
                'SZ' => [
                    'value' => 'SZ',
                    'description' => 'Eswatini'
                ],
                'TC' => [
                    'value' => 'TC',
                    'description' => 'Turks and Caicos Islands'
                ],
                'TD' => [
                    'value' => 'TD',
                    'description' => 'Chad'
                ],
                'TF' => [
                    'value' => 'TF',
                    'description' => 'French Southern Territories'
                ],
                'TG' => [
                    'value' => 'TG',
                    'description' => 'Togo'
                ],
                'TH' => [
                    'value' => 'TH',
                    'description' => 'Thailand'
                ],
                'TJ' => [
                    'value' => 'TJ',
                    'description' => 'Tajikistan'
                ],
                'TK' => [
                    'value' => 'TK',
                    'description' => 'Tokelau'
                ],
                'TL' => [
                    'value' => 'TL',
                    'description' => 'Timor-Leste'
                ],
                'TM' => [
                    'value' => 'TM',
                    'description' => 'Turkmenistan'
                ],
                'TN' => [
                    'value' => 'TN',
                    'description' => 'Tunisia'
                ],
                'TO' => [
                    'value' => 'TO',
                    'description' => 'Tonga'
                ],
                'TR' => [
                    'value' => 'TR',
                    'description' => 'Turkey'
                ],
                'TT' => [
                    'value' => 'TT',
                    'description' => 'Trinidad and Tobago'
                ],
                'TV' => [
                    'value' => 'TV',
                    'description' => 'Tuvalu'
                ],
                'TW' => [
                    'value' => 'TW',
                    'description' => 'Taiwan, Province of China'
                ],
                'TZ' => [
                    'value' => 'TZ',
                    'description' => 'Tanzania, United Republic of'
                ],
                'UA' => [
                    'value' => 'UA',
                    'description' => 'Ukraine'
                ],
                'UG' => [
                    'value' => 'UG',
                    'description' => 'Uganda'
                ],
                'UM' => [
                    'value' => 'UM',
                    'description' => 'United States Minor Outlying Islands'
                ],
                'US' => [
                    'value' => 'US',
                    'description' => 'United States of America'
                ],
                'UY' => [
                    'value' => 'UY',
                    'description' => 'Uruguay'
                ],
                'UZ' => [
                    'value' => 'UZ',
                    'description' => 'Uzbekistan'
                ],
                'VA' => [
                    'value' => 'VA',
                    'description' => 'Holy See'
                ],
                'VC' => [
                    'value' => 'VC',
                    'description' => 'Saint Vincent and the Grenadines'
                ],
                'VE' => [
                    'value' => 'VE',
                    'description' => 'Venezuela (Bolivarian Republic of)'
                ],
                'VG' => [
                    'value' => 'VG',
                    'description' => 'Virgin Islands (British)'
                ],
                'VI' => [
                    'value' => 'VI',
                    'description' => 'Virgin Islands (U.S.)'
                ],
                'VN' => [
                    'value' => 'VN',
                    'description' => 'Viet Nam'
                ],
                'VU' => [
                    'value' => 'VU',
                    'description' => 'Vanuatu'
                ],
                'WF' => [
                    'value' => 'WF',
                    'description' => 'Wallis and Futuna'
                ],
                'WS' => [
                    'value' => 'WS',
                    'description' => 'Samoa'
                ],
                'YE' => [
                    'value' => 'YE',
                    'description' => 'Yemen'
                ],
                'YT' => [
                    'value' => 'YT',
                    'description' => 'Mayotte'
                ],
                'ZA' => [
                    'value' => 'ZA',
                    'description' => 'South Africa'
                ],
                'ZM' => [
                    'value' => 'ZM',
                    'description' => 'Zambia'
                ],
                'ZW' => [
                    'value' => 'ZW',
                    'description' => 'Zimbabwe'
                ],

                // temporary, not officially assigned
                'XK' => [
                    'value' => 'XK',
                    'description' => 'Kosovo'
                ],

                // placeholder for unknown/undefined country
                'XX' => [
                    'value' => 'XX',
                    'description' => 'unknown'
                ],
            ]
        ]);
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getCountryNameForCode(string $code): string
    {
        $hash = self::getAsHash();
        return $hash[$code] ?? $hash['XX'];
    }

    protected static array $alpha2to3 = [
        'AF' => 'AFG',
        'AL' => 'ALB',
        'DZ' => 'DZA',
        'AS' => 'ASM',
        'AD' => 'AND',
        'AO' => 'AGO',
        'AI' => 'AIA',
        'AQ' => 'ATA',
        'AG' => 'ATG',
        'AR' => 'ARG',
        'AM' => 'ARM',
        'AW' => 'ABW',
        'AU' => 'AUS',
        'AT' => 'AUT',
        'AZ' => 'AZE',
        'BS' => 'BHS',
        'BH' => 'BHR',
        'BD' => 'BGD',
        'BB' => 'BRB',
        'BY' => 'BLR',
        'BE' => 'BEL',
        'BZ' => 'BLZ',
        'BJ' => 'BEN',
        'BM' => 'BMU',
        'BT' => 'BTN',
        'BO' => 'BOL',
        'BQ' => 'BES',
        'BA' => 'BIH',
        'BW' => 'BWA',
        'BV' => 'BVT',
        'BR' => 'BRA',
        'IO' => 'IOT',
        'BN' => 'BRN',
        'BG' => 'BGR',
        'BF' => 'BFA',
        'BI' => 'BDI',
        'CV' => 'CPV',
        'KH' => 'KHM',
        'CM' => 'CMR',
        'CA' => 'CAN',
        'KY' => 'CYM',
        'CF' => 'CAF',
        'TD' => 'TCD',
        'CL' => 'CHL',
        'CN' => 'CHN',
        'CX' => 'CXR',
        'CC' => 'CCK',
        'CO' => 'COL',
        'KM' => 'COM',
        'CD' => 'COD',
        'CG' => 'COG',
        'CK' => 'COK',
        'CR' => 'CRI',
        'HR' => 'HRV',
        'CU' => 'CUB',
        'CW' => 'CUW',
        'CY' => 'CYP',
        'CZ' => 'CZE',
        'CI' => 'CIV',
        'DK' => 'DNK',
        'DJ' => 'DJI',
        'DM' => 'DMA',
        'DO' => 'DOM',
        'EC' => 'ECU',
        'EG' => 'EGY',
        'SV' => 'SLV',
        'GQ' => 'GNQ',
        'ER' => 'ERI',
        'EE' => 'EST',
        'SZ' => 'SWZ',
        'ET' => 'ETH',
        'FK' => 'FLK',
        'FO' => 'FRO',
        'FJ' => 'FJI',
        'FI' => 'FIN',
        'FR' => 'FRA',
        'GF' => 'GUF',
        'PF' => 'PYF',
        'TF' => 'ATF',
        'GA' => 'GAB',
        'GM' => 'GMB',
        'GE' => 'GEO',
        'DE' => 'DEU',
        'GH' => 'GHA',
        'GI' => 'GIB',
        'GR' => 'GRC',
        'GL' => 'GRL',
        'GD' => 'GRD',
        'GP' => 'GLP',
        'GU' => 'GUM',
        'GT' => 'GTM',
        'GG' => 'GGY',
        'GN' => 'GIN',
        'GW' => 'GNB',
        'GY' => 'GUY',
        'HT' => 'HTI',
        'HM' => 'HMD',
        'VA' => 'VAT',
        'HN' => 'HND',
        'HK' => 'HKG',
        'HU' => 'HUN',
        'IS' => 'ISL',
        'IN' => 'IND',
        'ID' => 'IDN',
        'IR' => 'IRN',
        'IQ' => 'IRQ',
        'IE' => 'IRL',
        'IM' => 'IMN',
        'IL' => 'ISR',
        'IT' => 'ITA',
        'JM' => 'JAM',
        'JP' => 'JPN',
        'JE' => 'JEY',
        'JO' => 'JOR',
        'KZ' => 'KAZ',
        'KE' => 'KEN',
        'KI' => 'KIR',
        'KP' => 'PRK',
        'KR' => 'KOR',
        'KW' => 'KWT',
        'KG' => 'KGZ',
        'LA' => 'LAO',
        'LV' => 'LVA',
        'LB' => 'LBN',
        'LS' => 'LSO',
        'LR' => 'LBR',
        'LY' => 'LBY',
        'LI' => 'LIE',
        'LT' => 'LTU',
        'LU' => 'LUX',
        'MO' => 'MAC',
        'MG' => 'MDG',
        'MW' => 'MWI',
        'MY' => 'MYS',
        'MV' => 'MDV',
        'ML' => 'MLI',
        'MT' => 'MLT',
        'MH' => 'MHL',
        'MQ' => 'MTQ',
        'MR' => 'MRT',
        'MU' => 'MUS',
        'YT' => 'MYT',
        'MX' => 'MEX',
        'FM' => 'FSM',
        'MD' => 'MDA',
        'MC' => 'MCO',
        'MN' => 'MNG',
        'ME' => 'MNE',
        'MS' => 'MSR',
        'MA' => 'MAR',
        'MZ' => 'MOZ',
        'MM' => 'MMR',
        'NA' => 'NAM',
        'NR' => 'NRU',
        'NP' => 'NPL',
        'NL' => 'NLD',
        'NC' => 'NCL',
        'NZ' => 'NZL',
        'NI' => 'NIC',
        'NE' => 'NER',
        'NG' => 'NGA',
        'NU' => 'NIU',
        'NF' => 'NFK',
        'MP' => 'MNP',
        'NO' => 'NOR',
        'OM' => 'OMN',
        'PK' => 'PAK',
        'PW' => 'PLW',
        'PS' => 'PSE',
        'PA' => 'PAN',
        'PG' => 'PNG',
        'PY' => 'PRY',
        'PE' => 'PER',
        'PH' => 'PHL',
        'PN' => 'PCN',
        'PL' => 'POL',
        'PT' => 'PRT',
        'PR' => 'PRI',
        'QA' => 'QAT',
        'MK' => 'MKD',
        'RO' => 'ROU',
        'RU' => 'RUS',
        'RW' => 'RWA',
        'RE' => 'REU',
        'BL' => 'BLM',
        'SH' => 'SHN',
        'KN' => 'KNA',
        'LC' => 'LCA',
        'MF' => 'MAF',
        'PM' => 'SPM',
        'VC' => 'VCT',
        'WS' => 'WSM',
        'SM' => 'SMR',
        'ST' => 'STP',
        'SA' => 'SAU',
        'SN' => 'SEN',
        'RS' => 'SRB',
        'SC' => 'SYC',
        'SL' => 'SLE',
        'SG' => 'SGP',
        'SX' => 'SXM',
        'SK' => 'SVK',
        'SI' => 'SVN',
        'SB' => 'SLB',
        'SO' => 'SOM',
        'ZA' => 'ZAF',
        'GS' => 'SGS',
        'SS' => 'SSD',
        'ES' => 'ESP',
        'LK' => 'LKA',
        'SD' => 'SDN',
        'SR' => 'SUR',
        'SJ' => 'SJM',
        'SE' => 'SWE',
        'CH' => 'CHE',
        'SY' => 'SYR',
        'TW' => 'TWN',
        'TJ' => 'TJK',
        'TZ' => 'TZA',
        'TH' => 'THA',
        'TL' => 'TLS',
        'TG' => 'TGO',
        'TK' => 'TKL',
        'TO' => 'TON',
        'TT' => 'TTO',
        'TN' => 'TUN',
        'TR' => 'TUR',
        'TM' => 'TKM',
        'TC' => 'TCA',
        'TV' => 'TUV',
        'UG' => 'UGA',
        'UA' => 'UKR',
        'AE' => 'ARE',
        'GB' => 'GBR',
        'UM' => 'UMI',
        'US' => 'USA',
        'UY' => 'URY',
        'UZ' => 'UZB',
        'VU' => 'VUT',
        'VE' => 'VEN',
        'VN' => 'VNM',
        'VG' => 'VGB',
        'VI' => 'VIR',
        'WF' => 'WLF',
        'EH' => 'ESH',
        'YE' => 'YEM',
        'ZM' => 'ZMB',
        'ZW' => 'ZWE',
        'AX' => 'ALA'
    ];

    /** @var null|array */
    protected static ?array $alpha3to2 = null;

    /**
     * @param string $twoLetterCode
     * @return string
     */
    public static function convertAlpha2ToAlpha3(string $twoLetterCode): string
    {
        return self::$alpha2to3[$twoLetterCode] ?? 'XXX';
    }

    /**
     * @param string $threeLetterCode
     * @return string
     */
    public static function convertAlpha3ToAlpha2(string $threeLetterCode): string
    {
        if (is_null(self::$alpha3to2)) {
            self::$alpha3to2 = array_flip(self::$alpha2to3);
        }
        return self::$alpha3to2[$threeLetterCode] ?? 'XX';
    }

    /**
     * @param string $countryName
     * @return string
     */
    public static function guessCountryCode(string $countryName): string
    {
        $countries = array_flip(self::getAsHash());
        if (isset($countries[$countryName])) {
            return $countries[$countryName];
        }
        $parts = [];
        foreach ($countries as $name => $code) {
            $part = explode(',', $name, 1)[0];
            $part = trim(explode('(', $part, 1)[0]);
            $parts[$code] = $part;
        }

        foreach ($parts as $code => $part) {
            if ($countryName === $part) {
                return $code;
            }
        }
        foreach ($parts as $code => $part) {
            if (strpos($part, $countryName) !== false || (strlen($countryName) > 3 && strpos($countryName, $part) !== false)) {
                return $code;
            }
        }
        foreach ($parts as $code => $part) {
            if (strlen($countryName) > 3 && soundex($part) === soundex($countryName)) {
                return $code;
            }
        }
        return 'XX';
    }

}
