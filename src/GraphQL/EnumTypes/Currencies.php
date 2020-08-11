<?php


namespace HelloCash\HelloMicroservice\GraphQL\EnumTypes;


use GraphQL\Type\Definition\EnumType;

class Currencies extends BaseEnum
{
    public static function get(): EnumType
    {
        return new EnumType([
            'name' => 'CurrencyCode',
            'description' => 'ISO 4217',
            'values' => [
                'AED' => [
                    'value' => 'AED',
                    'description' => 'United Arab Emirates dirham'
                ],
                'AFN' => [
                    'value' => 'AFN',
                    'description' => 'Afghan afghani'
                ],
                'ALL' => [
                    'value' => 'ALL',
                    'description' => 'Albanian lek'
                ],
                'AMD' => [
                    'value' => 'AMD',
                    'description' => 'Armenian dram'
                ],
                'ANG' => [
                    'value' => 'ANG',
                    'description' => 'Netherlands Antillean guilder'
                ],
                'AOA' => [
                    'value' => 'AOA',
                    'description' => 'Angolan kwanza'
                ],
                'ARS' => [
                    'value' => 'ARS',
                    'description' => 'Argentine peso'
                ],
                'AUD' => [
                    'value' => 'AUD',
                    'description' => 'Australian dollar'
                ],
                'AWG' => [
                    'value' => 'AWG',
                    'description' => 'Aruban florin'
                ],
                'AZN' => [
                    'value' => 'AZN',
                    'description' => 'Azerbaijani manat'
                ],
                'BAM' => [
                    'value' => 'BAM',
                    'description' => 'Bosnia and Herzegovina convertible mark'
                ],
                'BBD' => [
                    'value' => 'BBD',
                    'description' => 'Barbados dollar'
                ],
                'BDT' => [
                    'value' => 'BDT',
                    'description' => 'Bangladeshi taka'
                ],
                'BGN' => [
                    'value' => 'BGN',
                    'description' => 'Bulgarian lev'
                ],
                'BHD' => [
                    'value' => 'BHD',
                    'description' => 'Bahraini dinar'
                ],
                'BIF' => [
                    'value' => 'BIF',
                    'description' => 'Burundian franc'
                ],
                'BMD' => [
                    'value' => 'BMD',
                    'description' => 'Bermudian dollar'
                ],
                'BND' => [
                    'value' => 'BND',
                    'description' => 'Brunei dollar'
                ],
                'BOB' => [
                    'value' => 'BOB',
                    'description' => 'Boliviano'
                ],
                'BRL' => [
                    'value' => 'BRL',
                    'description' => 'Brazilian real'
                ],
                'BSD' => [
                    'value' => 'BSD',
                    'description' => 'Bahamian dollar'
                ],
                'BTN' => [
                    'value' => 'BTN',
                    'description' => 'Bhutanese ngultrum'
                ],
                'BWP' => [
                    'value' => 'BWP',
                    'description' => 'Botswana pula'
                ],
                'BYN' => [
                    'value' => 'BYN',
                    'description' => 'Belarusian ruble'
                ],
                'BZD' => [
                    'value' => 'BZD',
                    'description' => 'Belize dollar'
                ],
                'CAD' => [
                    'value' => 'CAD',
                    'description' => 'Canadian dollar'
                ],
                'CDF' => [
                    'value' => 'CDF',
                    'description' => 'Congolese franc'
                ],
                'CHF' => [
                    'value' => 'CHF',
                    'description' => 'Swiss franc'
                ],
                'CLP' => [
                    'value' => 'CLP',
                    'description' => 'Chilean peso'
                ],
                'CNY' => [
                    'value' => 'CNY',
                    'description' => 'Chinese yuan[8]'
                ],
                'COP' => [
                    'value' => 'COP',
                    'description' => 'Colombian peso'
                ],
                'CRC' => [
                    'value' => 'CRC',
                    'description' => 'Costa Rican colon'
                ],
                'CUC' => [
                    'value' => 'CUC',
                    'description' => 'Cuban convertible peso'
                ],
                'CUP' => [
                    'value' => 'CUP',
                    'description' => 'Cuban peso'
                ],
                'CVE' => [
                    'value' => 'CVE',
                    'description' => 'Cape Verdean escudo'
                ],
                'CZK' => [
                    'value' => 'CZK',
                    'description' => 'Czech koruna'
                ],
                'DJF' => [
                    'value' => 'DJF',
                    'description' => 'Djiboutian franc'
                ],
                'DKK' => [
                    'value' => 'DKK',
                    'description' => 'Danish krone'
                ],
                'DOP' => [
                    'value' => 'DOP',
                    'description' => 'Dominican peso'
                ],
                'DZD' => [
                    'value' => 'DZD',
                    'description' => 'Algerian dinar'
                ],
                'EGP' => [
                    'value' => 'EGP',
                    'description' => 'Egyptian pound'
                ],
                'ERN' => [
                    'value' => 'ERN',
                    'description' => 'Eritrean nakfa'
                ],
                'ETB' => [
                    'value' => 'ETB',
                    'description' => 'Ethiopian birr'
                ],
                'EUR' => [
                    'value' => 'EUR',
                    'description' => 'Euro'
                ],
                'FJD' => [
                    'value' => 'FJD',
                    'description' => 'Fiji dollar'
                ],
                'FKP' => [
                    'value' => 'FKP',
                    'description' => 'Falkland Islands pound'
                ],
                'GBP' => [
                    'value' => 'GBP',
                    'description' => 'Pound sterling'
                ],
                'GEL' => [
                    'value' => 'GEL',
                    'description' => 'Georgian lari'
                ],
                'GHS' => [
                    'value' => 'GHS',
                    'description' => 'Ghanaian cedi'
                ],
                'GIP' => [
                    'value' => 'GIP',
                    'description' => 'Gibraltar pound'
                ],
                'GMD' => [
                    'value' => 'GMD',
                    'description' => 'Gambian dalasi'
                ],
                'GNF' => [
                    'value' => 'GNF',
                    'description' => 'Guinean franc'
                ],
                'GTQ' => [
                    'value' => 'GTQ',
                    'description' => 'Guatemalan quetzal'
                ],
                'GYD' => [
                    'value' => 'GYD',
                    'description' => 'Guyanese dollar'
                ],
                'HKD' => [
                    'value' => 'HKD',
                    'description' => 'Hong Kong dollar'
                ],
                'HNL' => [
                    'value' => 'HNL',
                    'description' => 'Honduran lempira'
                ],
                'HRK' => [
                    'value' => 'HRK',
                    'description' => 'Croatian kuna'
                ],
                'HTG' => [
                    'value' => 'HTG',
                    'description' => 'Haitian gourde'
                ],
                'HUF' => [
                    'value' => 'HUF',
                    'description' => 'Hungarian forint'
                ],
                'IDR' => [
                    'value' => 'IDR',
                    'description' => 'Indonesian rupiah'
                ],
                'ILS' => [
                    'value' => 'ILS',
                    'description' => 'Israeli new shekel'
                ],
                'INR' => [
                    'value' => 'INR',
                    'description' => 'Indian rupee'
                ],
                'IQD' => [
                    'value' => 'IQD',
                    'description' => 'Iraqi dinar'
                ],
                'IRR' => [
                    'value' => 'IRR',
                    'description' => 'Iranian rial'
                ],
                'ISK' => [
                    'value' => 'ISK',
                    'description' => 'Icelandic króna'
                ],
                'JMD' => [
                    'value' => 'JMD',
                    'description' => 'Jamaican dollar'
                ],
                'JOD' => [
                    'value' => 'JOD',
                    'description' => 'Jordanian dinar'
                ],
                'JPY' => [
                    'value' => 'JPY',
                    'description' => 'Japanese yen'
                ],
                'KES' => [
                    'value' => 'KES',
                    'description' => 'Kenyan shilling'
                ],
                'KGS' => [
                    'value' => 'KGS',
                    'description' => 'Kyrgyzstani som'
                ],
                'KHR' => [
                    'value' => 'KHR',
                    'description' => 'Cambodian riel'
                ],
                'KMF' => [
                    'value' => 'KMF',
                    'description' => 'Comoro franc'
                ],
                'KPW' => [
                    'value' => 'KPW',
                    'description' => 'North Korean won'
                ],
                'KRW' => [
                    'value' => 'KRW',
                    'description' => 'South Korean won'
                ],
                'KWD' => [
                    'value' => 'KWD',
                    'description' => 'Kuwaiti dinar'
                ],
                'KYD' => [
                    'value' => 'KYD',
                    'description' => 'Cayman Islands dollar'
                ],
                'KZT' => [
                    'value' => 'KZT',
                    'description' => 'Kazakhstani tenge'
                ],
                'LAK' => [
                    'value' => 'LAK',
                    'description' => 'Lao kip'
                ],
                'LBP' => [
                    'value' => 'LBP',
                    'description' => 'Lebanese pound'
                ],
                'LKR' => [
                    'value' => 'LKR',
                    'description' => 'Sri Lankan rupee'
                ],
                'LRD' => [
                    'value' => 'LRD',
                    'description' => 'Liberian dollar'
                ],
                'LSL' => [
                    'value' => 'LSL',
                    'description' => 'Lesotho loti'
                ],
                'LYD' => [
                    'value' => 'LYD',
                    'description' => 'Libyan dinar'
                ],
                'MAD' => [
                    'value' => 'MAD',
                    'description' => 'Moroccan dirham'
                ],
                'MDL' => [
                    'value' => 'MDL',
                    'description' => 'Moldovan leu'
                ],
                'MGA' => [
                    'value' => 'MGA',
                    'description' => '[c]Malagasy ariary'
                ],
                'MKD' => [
                    'value' => 'MKD',
                    'description' => 'Macedonian denar'
                ],
                'MMK' => [
                    'value' => 'MMK',
                    'description' => 'Myanmar kyat'
                ],
                'MNT' => [
                    'value' => 'MNT',
                    'description' => 'Mongolian tögrög'
                ],
                'MOP' => [
                    'value' => 'MOP',
                    'description' => 'Macanese pataca'
                ],
                'MRU' => [
                    'value' => 'MRU',
                    'description' => 'Mauritanian ouguiya'
                ],
                'MUR' => [
                    'value' => 'MUR',
                    'description' => 'Mauritian rupee'
                ],
                'MVR' => [
                    'value' => 'MVR',
                    'description' => 'Maldivian rufiyaa'
                ],
                'MWK' => [
                    'value' => 'MWK',
                    'description' => 'Malawian kwacha'
                ],
                'MXN' => [
                    'value' => 'MXN',
                    'description' => 'Mexican peso'
                ],
                'MYR' => [
                    'value' => 'MYR',
                    'description' => 'Malaysian ringgit'
                ],
                'MZN' => [
                    'value' => 'MZN',
                    'description' => 'Mozambican metical'
                ],
                'NAD' => [
                    'value' => 'NAD',
                    'description' => 'Namibian dollar'
                ],
                'NGN' => [
                    'value' => 'NGN',
                    'description' => 'Nigerian naira'
                ],
                'NIO' => [
                    'value' => 'NIO',
                    'description' => 'Nicaraguan córdoba'
                ],
                'NOK' => [
                    'value' => 'NOK',
                    'description' => 'Norwegian krone'
                ],
                'NPR' => [
                    'value' => 'NPR',
                    'description' => 'Nepalese rupee'
                ],
                'NZD' => [
                    'value' => 'NZD',
                    'description' => 'New Zealand dollar'
                ],
                'OMR' => [
                    'value' => 'OMR',
                    'description' => 'Omani rial'
                ],
                'PAB' => [
                    'value' => 'PAB',
                    'description' => 'Panamanian balboa'
                ],
                'PEN' => [
                    'value' => 'PEN',
                    'description' => 'Peruvian sol'
                ],
                'PGK' => [
                    'value' => 'PGK',
                    'description' => 'Papua New Guinean kina'
                ],
                'PHP' => [
                    'value' => 'PHP',
                    'description' => 'Philippine peso'
                ],
                'PKR' => [
                    'value' => 'PKR',
                    'description' => 'Pakistani rupee'
                ],
                'PLN' => [
                    'value' => 'PLN',
                    'description' => 'Polish złoty'
                ],
                'PYG' => [
                    'value' => 'PYG',
                    'description' => 'Paraguayan guaraní'
                ],
                'QAR' => [
                    'value' => 'QAR',
                    'description' => 'Qatari riyal'
                ],
                'RON' => [
                    'value' => 'RON',
                    'description' => 'Romanian leu'
                ],
                'RSD' => [
                    'value' => 'RSD',
                    'description' => 'Serbian dinar'
                ],
                'RUB' => [
                    'value' => 'RUB',
                    'description' => 'Russian ruble'
                ],
                'RWF' => [
                    'value' => 'RWF',
                    'description' => 'Rwandan franc'
                ],
                'SAR' => [
                    'value' => 'SAR',
                    'description' => 'Saudi riyal'
                ],
                'SBD' => [
                    'value' => 'SBD',
                    'description' => 'Solomon Islands dollar'
                ],
                'SCR' => [
                    'value' => 'SCR',
                    'description' => 'Seychelles rupee'
                ],
                'SDG' => [
                    'value' => 'SDG',
                    'description' => 'Sudanese pound'
                ],
                'SEK' => [
                    'value' => 'SEK',
                    'description' => 'Swedish krona/kronor'
                ],
                'SGD' => [
                    'value' => 'SGD',
                    'description' => 'Singapore dollar'
                ],
                'SHP' => [
                    'value' => 'SHP',
                    'description' => 'Saint Helena pound'
                ],
                'SLL' => [
                    'value' => 'SLL',
                    'description' => 'Sierra Leonean leone'
                ],
                'SOS' => [
                    'value' => 'SOS',
                    'description' => 'Somali shilling'
                ],
                'SRD' => [
                    'value' => 'SRD',
                    'description' => 'Surinamese dollar'
                ],
                'SSP' => [
                    'value' => 'SSP',
                    'description' => 'South Sudanese pound'
                ],
                'STN' => [
                    'value' => 'STN',
                    'description' => 'São Tomé and Príncipe dobra'
                ],
                'SVC' => [
                    'value' => 'SVC',
                    'description' => 'Salvadoran colón'
                ],
                'SYP' => [
                    'value' => 'SYP',
                    'description' => 'Syrian pound'
                ],
                'SZL' => [
                    'value' => 'SZL',
                    'description' => 'Swazi lilangeni'
                ],
                'THB' => [
                    'value' => 'THB',
                    'description' => 'Thai baht'
                ],
                'TJS' => [
                    'value' => 'TJS',
                    'description' => 'Tajikistani somoni'
                ],
                'TMT' => [
                    'value' => 'TMT',
                    'description' => 'Turkmenistan manat'
                ],
                'TND' => [
                    'value' => 'TND',
                    'description' => 'Tunisian dinar'
                ],
                'TOP' => [
                    'value' => 'TOP',
                    'description' => 'Tongan paʻanga'
                ],
                'TRY' => [
                    'value' => 'TRY',
                    'description' => 'Turkish lira'
                ],
                'TTD' => [
                    'value' => 'TTD',
                    'description' => 'Trinidad and Tobago dollar'
                ],
                'TWD' => [
                    'value' => 'TWD',
                    'description' => 'New Taiwan dollar'
                ],
                'TZS' => [
                    'value' => 'TZS',
                    'description' => 'Tanzanian shilling'
                ],
                'UAH' => [
                    'value' => 'UAH',
                    'description' => 'Ukrainian hryvnia'
                ],
                'UGX' => [
                    'value' => 'UGX',
                    'description' => 'Ugandan shilling'
                ],
                'USD' => [
                    'value' => 'USD',
                    'description' => 'United States dollar'
                ],
                'UYU' => [
                    'value' => 'UYU',
                    'description' => 'Uruguayan peso'
                ],
                'UYW' => [
                    'value' => 'UYW',
                    'description' => 'Unidad previsional'
                ],
                'UZS' => [
                    'value' => 'UZS',
                    'description' => 'Uzbekistan som'
                ],
                'VES' => [
                    'value' => 'VES',
                    'description' => 'Venezuelan bolívar soberano'
                ],
                'VND' => [
                    'value' => 'VND',
                    'description' => 'Vietnamese đồng'
                ],
                'VUV' => [
                    'value' => 'VUV',
                    'description' => 'Vanuatu vatu'
                ],
                'WST' => [
                    'value' => 'WST',
                    'description' => 'Samoan tala'
                ],
                'XXX' => [
                    'value' => 'XXX',
                    'description' => 'No currency'
                ],
                'YER' => [
                    'value' => 'YER',
                    'description' => 'Yemeni rial'
                ],
                'ZAR' => [
                    'value' => 'ZAR',
                    'description' => 'South African rand'
                ],
                'ZMW' => [
                    'value' => 'ZMW',
                    'description' => 'Zambian kwacha'
                ],
                'ZWL' => [
                    'value' => 'ZWL',
                    'description' => 'Zimbabwean dollar'
                ],
            ]
        ]);
    }

    public static function getCurrencyNameForCode($code)
    {
        $hash = self::getAsHash();
        return $hash[$code] ?? $hash['XX'];
    }

    protected static $currencyToCountry = null;
    protected static $countryToCurrency = null;

    protected static function fillCurrencyToCountry()
    {
        self::$currencyToCountry = [];
        self::$countryToCurrency = [];
        $countries = Countries::getAsHash();
        foreach (self::getAsHash() as $currencyCode => $currencyName) {
            $countryCode = substr($currencyCode, 0, 2);
            if (isset($countries[$countryCode])) {
                self::$currencyToCountry[$currencyCode] = $countryCode;
                self::$currencyToCountry[$countryCode] = $currencyCode;
            }
        }
    }

    public static function getCurrencyForCountry($countryCode)
    {
        if (is_null(self::$countryToCurrency)) {
            self::fillCurrencyToCountry();
        }
        return self::$countryToCurrency[$countryCode] ?? 'XXX';
    }

    public static function getCountryForCurrency($currencyCode)
    {
        if (is_null(self::$currencyToCountry)) {
            self::fillCurrencyToCountry();
        }
        return self::$currencyToCountry[$currencyCode] ?? 'XX';
    }

}
