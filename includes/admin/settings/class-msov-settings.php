<?php

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

if ( ! class_exists( 'MSOV_Settings' ) ) :

    class MSOV_Settings {
        static function update_settings(){
            include_once MSOV()->plugin_path() . '/includes/admin/setting-manager/mshop-setting-helper.php';

            $_REQUEST = array_merge( $_REQUEST, json_decode( stripslashes($_REQUEST['values']), true ) );

            MSSHelper::update_settings( self::get_setting_fields() );

            wp_send_json_success();
        }

	    static  function get_setting_fields(){
            return array(
                'type' => 'Tab',
                'id' => 'msov-setting-tab',
                'elements' => array(
                    self::get_setting_ownership_verification_tab(),
                    self::get_setting_track_verification_tab()
                )
            );
        }

	    static  function get_setting_ownership_verification_tab() {
		    return array(
				    'type'     => 'Page',
				    'title'    => __( '엠샵 웹사이트 소유권 인증', 'mshop-ownership-verification' ),
				    'class'    => 'active',
				    'elements' => array(
						    array(
								    'type'     => 'Section',
								    'title'    => __( '웹사이트 소유권 인증 기능 사용', 'mshop-ownership-verification' ),
								    'elements' => array(
										    array(
												    'id'        => 'msov_enabled',
												    'title'     => __( '활성화', 'mshop-ownership-verification' ),
												    'className' => '',
												    'type'      => 'Toggle',
												    'default'   => 'no',
												    'desc'      => __( '웹사이트 소유권 인증 기능을 사용합니다.', 'mshop-ownership-verification' )
										    )
								    )
						    ),
						    array(
								    'type'     => 'Section',
								    'title'    => __( '파라미터 설정', 'mshop-ownership-verification' ),
								    'showIf'   => array( 'msov_enabled' => 'yes' ),
								    'elements' => array(
										    array(
												    "id"        => "msov_verification_params",
												    "className" => "",
												    "sortable"  => 'true',
												    "editable"  => 'true',
												    "repeater"  => 'true',
												    "type"      => "SortableTable",
												    "template"  => array(
														    'service' => '',
														    'content' => ''
												    ),
												    "elements"  => array(
														    array(
																    "id"          => "service",
																    "title"       => __( "검색엔진", 'mshop-ownership-verification' ),
																    "className"   => " seven wide column fluid",
																    "type"        => "Select",
																    'default'     => '',
																    'placeHolder' => __( '검색엔진을 선택하세요.', 'mshop-ownership-verification' ),
																    'options'     => apply_filters( 'msov_search_engines', array(
																		    'google' => __( '구글(Google)', 'mshop-ownership-verification' ),
																		    'naver'  => __( '네이버(Naver)', 'mshop-ownership-verification' ),
																			'msvalidate.01'  => __( '빙(Bing)', 'mshop-ownership-verification' ),
																			'y_key'  => __( '야후(Yahoo)', 'mshop-ownership-verification' ),
																    ) )
														    ),
														    array(
																    "id"          => "content",
																    "className"   => " seven wide column fluid",
																    "title"       => __( "컨텐츠", 'mshop-ownership-verification' ),
																    "type"        => "Text",
																    'placeHolder' => __( '키값을 입력하세요.', 'mshop-ownership-verification' ),
														    )
												    )
										    ),
								    )
						    )
				    )
		    );
	    }
        static  function get_setting_track_verification_tab() {
            return array(
                    'type'     => 'Page',
                    'title'    => __( '광고 전환 추적', 'mshop-ownership-verification' ),
                    'elements' => array(
                            array(
                                'type'     => 'Section',
                                'title'    => __( '전환 추적 기능 사용', 'mshop-ownership-verification' ),
                                'elements' => array(
                                        array(
                                                'id'        => 'msov_track_enabled',
                                                'title'     => __( '활성화', 'mshop-ownership-verification' ),
                                                'className' => '',
                                                'type'      => 'Toggle',
                                                'default'   => 'no',
                                                'desc'      => __( '전환 추적 기능을 사용합니다.', 'mshop-ownership-verification' )
                                        )
                                )
                        ),
                        array(
                                'type'     => 'Section',
                                'title'    => __( '아이디 설정', 'mshop-ownership-verification' ),
                                'showIf'   => array( 'msov_track_enabled' => 'yes' ),
                                'elements' => array(
                                        array(
                                                "id"        => "msov_conversation_params",
                                                "className" => "",
                                                "sortable"  => 'true',
                                        "editable"  => 'true',
                                                "repeater"  => 'true',
                                                "type"      => "SortableTable",
                                                "template"  => array(
                                                    'track_service' => '',
                                                    'track_content' => ''
                                                ),
                                                "elements"  => array(
                                                        array(
                                                            "id"          => "track_service",
                                                            "title"       => __( "광고매체", 'mshop-ownership-verification' ),
                                                            "className"   => " seven wide column fluid",

                                                            "type"        => "Select",
                                                            'default'     => '',
                                                            'placeHolder' => __( '광고매체를 선택하세요.', 'mshop-ownership-verification' ),
                                                            'options'     => apply_filters( 'msov_search_engines', array(
                                                                'google' => __( '구글(Google)', 'mshop-ownership-verification' ),
                                                                'facebook'  => __( '페이스북(Facebook)', 'mshop-ownership-verification' ),
                                                                'naver'  => __( '네이버(Naver)', 'mshop-ownership-verification' ),

                                                            ) )
                                                        ),
                                                        array(
                                                            "id"          => "track_content",
                                                            "className"   => " seven wide column fluid",
                                                            "title"       => __( "아이디", 'mshop-ownership-verification' ),
                                                            "type"        => "Text",
                                                            'placeholder' => __( '키값을 입력하세요.', 'mshop-ownership-verification' ),
                                                        )
                                                )
                                        ),
                                )
                        )
                    )
            );
        }

        static function enqueue_scripts(){
            wp_enqueue_style( 'mshop-setting-manager', MSOV()->plugin_url() . '/includes/admin/setting-manager/css/setting-manager.min.css');
            wp_enqueue_script( 'mshop-setting-manager', MSOV()->plugin_url() . '/includes/admin/setting-manager/js/setting-manager.min.js', array( 'jquery', 'jquery-ui-core' ));
        }
        public static function output() {
	        require_once MSOV()->plugin_path() . '/includes/admin/setting-manager/mshop-setting-helper.php';

	        self::enqueue_scripts();

	        $settings = self::get_setting_fields();

	        wp_localize_script( 'mshop-setting-manager', 'mshop_setting_manager', array(
			        'element'  => 'mshop-setting-wrapper',
			        'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			        'action'   => MSOV()->slug() . '-update_settings',
			        'settings' => $settings
	        ) );

	        ?>
	        <script>
		        jQuery(document).ready(function () {
			        jQuery(this).trigger('mshop-setting-manager', ['mshop-setting-wrapper', '100', <?php echo json_encode( MSSHelper::get_settings( $settings ) ); ?>, null, null]);
		        });
	        </script>

	        <div id="mshop-setting-wrapper"></div>
	        <?php
        }
    }

endif;

return new MSOV_Settings();


