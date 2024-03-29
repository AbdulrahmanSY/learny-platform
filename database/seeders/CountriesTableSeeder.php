<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CountriesTableSeeder extends Seeder {

	public function run(): void
    {
		DB::table('countries')->delete();

		$countries = array(
            array( 'country_name' => 'United States'),
            array( 'country_name' => 'Canada'),
            array( 'country_name' => 'Afghanistan'),
            array( 'country_name' => 'Albania'),
			array( 'country_name' => 'Algeria'),
			array( 'country_name' => 'American Samoa'),
			array( 'country_name' => 'Andorra'),
			array( 'country_name' => 'Angola'),
			array( 'country_name' => 'Anguilla'),
			array( 'country_name' => 'Antarctica'),
			array( 'country_name' => 'Antigua and/or Barbuda'),
			array( 'country_name' => 'Argentina'),
			array( 'country_name' => 'Armenia'),
			array( 'country_name' => 'Aruba'),
			array( 'country_name' => 'Australia'),
			array( 'country_name' => 'Austria'),
			array( 'country_name' => 'Azerbaijan'),
			array( 'country_name' => 'Bahamas'),
			array( 'country_name' => 'Bahrain'),
			array( 'country_name' => 'Bangladesh'),
			array( 'country_name' => 'Barbados'),
			array( 'country_name' => 'Belarus'),
			array( 'country_name' => 'Belgium'),
			array( 'country_name' => 'Belize'),
			array( 'country_name' => 'Benin'),
			array( 'country_name' => 'Bermuda'),
			array( 'country_name' => 'Bhutan'),
			array( 'country_name' => 'Bolivia'),
			array( 'country_name' => 'Bosnia and Herzegovina'),
			array( 'country_name' => 'Botswana'),
			array( 'country_name' => 'Bouvet Island'),
			array( 'country_name' => 'Brazil'),
			array( 'country_name' => 'British lndian Ocean Territory'),
			array( 'country_name' => 'Brunei Darussalam'),
			array( 'country_name' => 'Bulgaria'),
			array( 'country_name' => 'Burkina Faso'),
			array( 'country_name' => 'Burundi'),
			array( 'country_name' => 'Cambodia'),
			array( 'country_name' => 'Cameroon'),
			array( 'country_name' => 'Cape Verde'),
			array( 'country_name' => 'Cayman Islands'),
			array( 'country_name' => 'Central African Republic'),
			array( 'country_name' => 'Chad'),
			array( 'country_name' => 'Chile'),
			array( 'country_name' => 'China'),
			array( 'country_name' => 'Christmas Island'),
			array( 'country_name' => 'Cocos (Keeling) Islands'),
			array( 'country_name' => 'Colombia'),
			array( 'country_name' => 'Comoros'),
			array( 'country_name' => 'Congo'),
			array( 'country_name' => 'Cook Islands'),
			array( 'country_name' => 'Costa Rica'),
			array( 'country_name' => 'Croatia (Hrvatska)'),
			array( 'country_name' => 'Cuba'),
			array( 'country_name' => 'Cyprus'),
			array( 'country_name' => 'Czech Republic'),
			array( 'country_name' => 'Democratic Republic of Congo'),
			array( 'country_name' => 'Denmark'),
			array( 'country_name' => 'Djibouti'),
			array( 'country_name' => 'Dominica'),
			array( 'country_name' => 'Dominican Republic'),
			array( 'country_name' => 'East Timor'),
			array( 'country_name' => 'Ecudaor'),
			array( 'country_name' => 'Egypt'),
			array( 'country_name' => 'El Salvador'),
			array( 'country_name' => 'Equatorial Guinea'),
			array( 'country_name' => 'Eritrea'),
			array( 'country_name' => 'Estonia'),
			array( 'country_name' => 'Ethiopia'),
			array( 'country_name' => 'Falkland Islands (Malvinas)'),
			array( 'country_name' => 'Faroe Islands'),
			array( 'country_name' => 'Fiji'),
			array( 'country_name' => 'Finland'),
			array( 'country_name' => 'France'),
			array( 'country_name' => 'France, Metropolitan'),
			array( 'country_name' => 'French Guiana'),
			array( 'country_name' => 'French Polynesia'),
			array( 'country_name' => 'French Southern Territories'),
			array( 'country_name' => 'Gabon'),
			array( 'country_name' => 'Gambia'),
			array( 'country_name' => 'Georgia'),
			array( 'country_name' => 'Germany'),
			array( 'country_name' => 'Ghana'),
			array( 'country_name' => 'Gibraltar'),
			array( 'country_name' => 'Greece'),
			array( 'country_name' => 'Greenland'),
			array( 'country_name' => 'Grenada'),
			array( 'country_name' => 'Guadeloupe'),
			array( 'country_name' => 'Guam'),
			array( 'country_name' => 'Guatemala'),
			array( 'country_name' => 'Guinea'),
			array( 'country_name' => 'Guinea-Bissau'),
			array( 'country_name' => 'Guyana'),
			array( 'country_name' => 'Haiti'),
			array( 'country_name' => 'Heard and Mc Donald Islands'),
			array( 'country_name' => 'Honduras'),
			array( 'country_name' => 'Hong Kong'),
			array( 'country_name' => 'Hungary'),
			array( 'country_name' => 'Iceland'),
			array( 'country_name' => 'India'),
			array( 'country_name' => 'Indonesia'),
			array( 'country_name' => 'Iran (Islamic Republic of)'),
			array( 'country_name' => 'Iraq'),
			array( 'country_name' => 'Ireland'),
			array( 'country_name' => 'Israel'),
			array( 'country_name' => 'Italy'),
			array( 'country_name' => 'Ivory Coast'),
			array( 'country_name' => 'Jamaica'),
			array( 'country_name' => 'Japan'),
			array( 'country_name' => 'Jordan'),
			array( 'country_name' => 'Kazakhstan'),
			array( 'country_name' => 'Kenya'),
			array( 'country_name' => 'Kiribati'),
			array( 'country_name' => 'Korea'),
			array( 'country_name' => 'Korea, Republic of'),
			array( 'country_name' => 'Kuwait'),
			array( 'country_name' => 'Kyrgyzstan'),
			array( 'country_name' => 'Lao People\'s Democratic Republic'),
			array( 'country_name' => 'Latvia'),
			array( 'country_name' => 'Lebanon'),
			array( 'country_name' => 'Lesotho'),
			array( 'country_name' => 'Liberia'),
			array( 'country_name' => 'Libyan Arab Mahira'),
			array( 'country_name' => 'Liechtenstein'),
			array( 'country_name' => 'Lithuania'),
			array( 'country_name' => 'Luxembourg'),
			array( 'country_name' => 'Macau'),
			array( 'country_name' => 'Macedonia'),
			array( 'country_name' => 'Madagascar'),
			array( 'country_name' => 'Malawi'),
			array( 'country_name' => 'Malaysia'),
			array( 'country_name' => 'Maldives'),
			array( 'country_name' => 'Mali'),
			array( 'country_name' => 'Malta'),
			array( 'country_name' => 'Marshall Islands'),
			array( 'country_name' => 'Martinique'),
			array( 'country_name' => 'Mauritania'),
			array( 'country_name' => 'Mauritius'),
			array( 'country_name' => 'Mayotte'),
			array( 'country_name' => 'Mexico'),
			array( 'country_name' => 'Micronesia, Federated States of'),
			array( 'country_name' => 'Moldova, Republic of'),
			array( 'country_name' => 'Monaco'),
			array( 'country_name' => 'Mongolia'),
			array( 'country_name' => 'Montserrat'),
			array( 'country_name' => 'Morocco'),
			array( 'country_name' => 'Mozambique'),
			array( 'country_name' => 'Myanmar'),
			array( 'country_name' => 'Namibia'),
			array( 'country_name' => 'Nauru'),
			array( 'country_name' => 'Nepal'),
			array( 'country_name' => 'Netherlands'),
			array( 'country_name' => 'Netherlands Antilles'),
			array( 'country_name' => 'New Caledonia'),
			array( 'country_name' => 'New Zealand'),
			array( 'country_name' => 'Nicaragua'),
			array( 'country_name' => 'Niger'),
			array( 'country_name' => 'Nigeria'),
			array( 'country_name' => 'Niue'),
			array( 'country_name' => 'Norfork Island'),
			array( 'country_name' => 'Northern Mariana Islands'),
			array( 'country_name' => 'Norway'),
			array( 'country_name' => 'Oman'),
			array( 'country_name' => 'Pakistan'),
			array( 'country_name' => 'Palau'),
			array( 'country_name' => 'Panama'),
			array( 'country_name' => 'Papua New Guinea'),
			array( 'country_name' => 'Paraguay'),
			array( 'country_name' => 'Peru'),
			array( 'country_name' => 'Philippines'),
			array( 'country_name' => 'Pitcairn'),
			array( 'country_name' => 'Poland'),
			array( 'country_name' => 'Portugal'),
			array( 'country_name' => 'Puerto Rico'),
			array( 'country_name' => 'Qatar'),
			array( 'country_name' => 'Republic of South Sudan'),
			array( 'country_name' => 'Reunion'),
			array( 'country_name' => 'Romania'),
			array( 'country_name' => 'Russian Federation'),
			array( 'country_name' => 'Rwanda'),
			array( 'country_name' => 'Saint Kitts and Nevis'),
			array( 'country_name' => 'Saint Lucia'),
			array( 'country_name' => 'Saint Vincent and the Grenadines'),
			array( 'country_name' => 'Samoa'),
			array( 'country_name' => 'San Marino'),
			array( 'country_name' => 'Sao Tome and Principe'),
			array( 'country_name' => 'Saudi Arabia'),
			array( 'country_name' => 'Senegal'),
			array( 'country_name' => 'Serbia'),
			array( 'country_name' => 'Seychelles'),
			array( 'country_name' => 'Sierra Leone'),
			array( 'country_name' => 'Singapore'),
			array( 'country_name' => 'Slovakia'),
			array( 'country_name' => 'Slovenia'),
			array( 'country_name' => 'Solomon Islands'),
			array( 'country_name' => 'Somalia'),
			array( 'country_name' => 'South Africa'),
			array( 'country_name' => 'South Georgia South Sandwich Islands'),
			array( 'country_name' => 'Spain'),
			array( 'country_name' => 'Sri Lanka'),
			array( 'country_name' => 'St. Helena'),
			array( 'country_name' => 'St. Pierre and Miquelon'),
			array( 'country_name' => 'Sudan'),
			array( 'country_name' => 'Suriname'),
			array( 'country_name' => 'Svalbarn and Jan Mayen Islands'),
			array( 'country_name' => 'Swaziland'),
			array( 'country_name' => 'Sweden'),
			array( 'country_name' => 'Switzerland'),
			array( 'country_name' => 'Syrian Arab Republic'),
			array( 'country_name' => 'Taiwan'),
			array( 'country_name' => 'Tajikistan'),
			array( 'country_name' => 'Tanzania, United Republic of'),
			array( 'country_name' => 'Thailand'),
			array( 'country_name' => 'Togo'),
			array( 'country_name' => 'Tokelau'),
			array( 'country_name' => 'Tonga'),
			array( 'country_name' => 'Trinidad and Tobago'),
			array( 'country_name' => 'Tunisia'),
			array( 'country_name' => 'Turkey'),
			array( 'country_name' => 'Turkmenistan'),
			array( 'country_name' => 'Turks and Caicos Islands'),
			array( 'country_name' => 'Tuvalu'),
			array( 'country_name' => 'Uganda'),
			array( 'country_name' => 'Ukraine'),
			array( 'country_name' => 'United Arab Emirates'),
			array( 'country_name' => 'United Kingdom'),
			array( 'country_name' => 'United States minor outlying islands'),
			array( 'country_name' => 'Uruguay'),
			array( 'country_name' => 'Uzbekistan'),
			array( 'country_name' => 'Vanuatu'),
			array( 'country_name' => 'Vatican City State'),
			array( 'country_name' => 'Venezuela'),
			array( 'country_name' => 'Vietnam'),
			array( 'country_name' => 'Virgin Islands (British)'),
			array( 'country_name' => 'Virgin Islands (U.S.)'),
			array( 'country_name' => 'Wallis and Futuna Islands'),
			array( 'country_name' => 'Western Sahara'),
			array( 'country_name' => 'Yemen'),
			array( 'country_name' => 'Yugoslavia'),
			array( 'country_name' => 'Zaire'),
			array( 'country_name' => 'Zambia'),
			array( 'country_name' => 'Zimbabwe'),
		);

		DB::table('countries')->insert($countries);
	}
}
