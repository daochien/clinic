export default {
    "en": {
        "request": {
            "attr": {
                "_title": "タイトル",
                "_category": "申請項目",
                "_sender": "申請者",
                "_approver": "承認担当者",
                "_status": "ステータス",
                "statuses": {
                    "_open": "承認待ち",
                    "_in_progress": "承認中",
                    "_approved": "承認済み",
                    "_rejected": "却下"
                },
                "_approval_comment": "承認欄",
                "approval_comment": {
                    "_yes": "あり",
                    "_no": "なし"
                },
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請一覧",
                "_page_title": "申請一覧",
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_request_at": "申請日時",
                    "_last_approved_at": "最終承認日時",
                    "actions": {
                        "_act_show_details": "詳細を確認する",
                        "_act_approve": "承認する",
                        "_act_reject": "却下する"
                    }
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。"
                },
                "others": {
                    "_no_data": "申請データが存在しません。",
                    "_no_search_result": "該当する申請データが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請詳細情報",
                "_page_title": "申請詳細情報",
                "basic_info": {
                    "_subtitle": "基本情報",
                    "_approval_comment_pl": "例）精算額など"
                },
                "form": {
                    "_subtitle": "申請情報"
                },
                "reply_form": {
                    "_comment_pl": "コメントを入力してください"
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。",
                    "_reply_success": "返信が成功しました。",
                    "_reply_failed": "返信に失敗しました。"
                },
                "others": {
                    "_btn_approve": "承認する",
                    "_btn_reject": "却下する",
                    "_btn_reply": "返信する"
                }
            },
            "template": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請テンプレート一覧",
                "_page_title": "申請テンプレート一覧",
                "data_table": {
                    "_created_at": "作成日時",
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remvoe": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "申請テンプレートの削除が成功しました。",
                    "_remove_failed": "申請テンプレートの削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規テンプレート作成",
                    "_no_data": "申請テンプレートが存在しません。"
                }
            },
            "others": {
                "_modal_no": "キャンセル",
                "_reject_modal_yes": "承認する",
                "_reject_modal_title": "申請を承認",
                "_reject_modal_description": "この申請を承認してもよろしいですか？",
                "_approve_modal_yes": "却下する",
                "_approve_modal_title": "申請を却下",
                "_approve_modal_description": "この申請を却下してもよろしいですか？",
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "申請テンプレートを削除",
                "_remove_modal_description": "このテンプレートを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "app": {
            "name": "友伸會ポータル管理画面",
            "menu": {
                "top": {
                    "_logout": "ログアウト"
                },
                "sidebar": {
                    "admin_management": {
                        "_main": "管理者アカウント管理",
                        "_admin_list": "管理者一覧",
                        "_role_list": "管理者役割一覧"
                    },
                    "staff_management": {
                        "_main": "スタッフ管理",
                        "_clinic_list": "クリニック一覧",
                        "_staff_list": "スタッフ一覧",
                        "_group_list": "グループ一覧"
                    },
                    "notification_management": {
                        "_main": "お知らせ管理"
                    },
                    "request_management": {
                        "_main": "申請管理",
                        "_request_template_list": "申請テンプレート一覧"
                    },
                    "inquiry_management": {
                        "_main": "問合せ管理"
                    },
                    "page_management": {
                        "_main": "ページ管理"
                    }
                }
            }
        },
        "staff": {
            "attr": {
                "_username": "ユーザー名",
                "_mail_address": "メールアドレス",
                "_position": "職業",
                "positions": {
                    "_dr": "DR",
                    "_dh": "DH",
                    "_others": "その他"
                },
                "_clinic": "クリニック",
                "_user_type": "ユーザータイプ",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・スタッフ一覧",
                "_page_title": "スタッフ一覧",
                "search_box": {
                    "_position_df": "すべての職業",
                    "_clinic_df": "すべてのクリニック",
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "スタッフ情報を編集する",
                        "_act_remove": "スタッフ情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "スタッフ情報の削除が成功しました。",
                    "_remove_failed": "スタッフ情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規スタッフ登録",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規スタッフ情報登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・スタッフ情報編集",
                "_page_title_create": "新規スタッフ情報登録",
                "_page_title_edit": "スタッフ情報編集",
                "form": {
                    "_form_title": "スタッフ情報",
                    "_username_pl": "ユーザー名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "職業を選択してください",
                    "_clinic_df": "クリニックを指定してください",
                    "user_type_opt": {
                        "_staff_web": "ウェブユーザー",
                        "_staff_mobile": "スマホアプリユーザー"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "新規スタッフの登録が成功しました。",
                    "_create_failed": "新規スタッフの登録に失敗しました。",
                    "_edit_success": "スタッフ情報の編集が成功しました。",
                    "_edit_failed": "スタッフ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "スタッフ情報を削除",
                "_remove_modal_description": "このスタッフの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "admin": {
            "attr": {
                "_username": "アカウント名",
                "_mail_address": "メールアドレス",
                "_position": "ポジション",
                "_role": "管理者役割",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧",
                "_page_title": "管理者一覧",
                "search_box": {
                    "_role_df": "すべての役割"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "管理者情報を編集する",
                        "_act_remove": "管理者情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者情報の削除が成功しました。",
                    "_remove_failed": "管理者情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規アカウント登録",
                    "_no_data": "管理者アカウントが存在しません。",
                    "_no_search_result": "該当する管理者情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集",
                "_page_title_create": "新規アカウント登録",
                "_page_title_edit": "管理者情報編集",
                "form": {
                    "_subtitle": "管理者情報",
                    "_username_pl": "アカウント名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "ポジションを選択してください",
                    "position_opt": {
                        "_bod": "理事長",
                        "_hr": "事務局"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "管理者アカウントの登録が成功しました。",
                    "_create_failed": "管理者アカウントの登録に失敗しました。",
                    "_edit_success": "管理者情報の編集が成功しました。",
                    "_edit_failed": "管理者情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "notification": {
            "attr": {
                "_title": "タイトル",
                "_target_users": "送信対象者",
                "_confirm_required": "承認必須",
                "_content": "本文",
                "_public_at": "公開日時",
                "_status": "ステータス",
                "status": {
                    "_draft": "下書き",
                    "_private": "非公開",
                    "_public": "公開"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ一覧",
                "_page_title": "お知らせ一覧",
                "search_box": {
                    "_target_users_df": "すべてのスタッフ",
                    "_public_date": "公開日付",
                    "_status": "公開ステータス",
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_sent_count": "配送総数",
                    "_read_count": "既読数",
                    "_confirmed_count": "確認済人数",
                    "actions": {
                        "_act_public": "お知らせを公開する",
                        "_act_edit": "編集する",
                        "_act_remove": "削除する",
                        "_act_show_details": "詳細を確認んする"
                    }
                },
                "messages": {
                    "_remove_success": "お知らせ削除が成功しました。",
                    "_remove_failed": "お知らせ削除に失敗しました。",
                    "_stt_update_success": "お知らせステータスの更新が成功しました。",
                    "_stt_update_failed": "お知らせステータスの更新に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規作成",
                    "_no_data": "お知らせデータが存在しません。",
                    "_no_search_result": "該当するお知らせデータが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ作成",
                "_page_title": "お知らせ作成",
                "form": {
                    "_subtitle": "お知らせ情報",
                    "_title_pl": "タイトルを入力してください",
                    "_target_users_des": "※拠点名、職業、及びユーザー名で入力することは可能です。",
                    "target_user_opt": {
                        "_dr": "DR",
                        "_dh": "DH",
                        "_manual": "対象者を指定する",
                        "_manual_pl": "送信対象者のユーザー名を入力してください"
                    }
                },
                "messages": {
                    "_create_success": "お知らせ作成が成功しました。",
                    "_create_failed": "お知らせ作成に失敗しました。",
                    "_draft_save_success": "お知らせの下書き保存が成功しました。",
                    "_draft_save_failed": "お知らせの下書き保存に失敗しました。"
                },
                "others": {
                    "_btn_draft_save": "下書きとして保存",
                    "_btn_create": "公開する",
                    "_btn_remove": "削除する"
                }
            },
            "noti_users": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・送信対象者一覧",
                "_page_title": "送信対象者一覧",
                "attr": {
                    "_status": "ステータス",
                    "status": {
                        "_unread": "未読",
                        "_read": "既読"
                    }
                },
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_confirmed_at": "確認日時"
                },
                "others": {
                    "_unconfirm": "---",
                    "_no_data": "送信対象者が存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "お知らせを削除",
                "_remove_modal_description": "このお知らせを削除してもよろしいですか？一度削除されたお知らせは復旧することはできません。"
            }
        },
        "role": {
            "attr": {
                "_name": "役割",
                "_permission": "権限"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割一覧",
                "_page_title": "管理者役割一覧",
                "data_table": {
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者役割の削除が成功しました。",
                    "_remove_failed": "管理者役割の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規役割登録",
                    "_no_data": "管理者役割が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規役割登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割編集",
                "_page_title_create": "新規役割登録",
                "_page_title_edit": "管理者役割編集",
                "form": {
                    "_form_title": "管理者役割情報",
                    "_name_pl": "管理者役割の名前を入力してください",
                    "permission_data": {
                        "_feature_list": "機能一覧",
                        "_all_permission": "すべての権限",
                        "_read": "読み取り",
                        "_create": "作成",
                        "_update": "更新",
                        "_remove": "削除",
                        "features": {
                            "_admin_management": "管理者アカウント管理",
                            "_role_management": "管理者役割管理",
                            "_clinic_management": "クリニック管理",
                            "_group_management": "グループ管理",
                            "_staff_management": "スタッフ管理",
                            "_notification_management": "お知らせ管理",
                            "_request_management": "申請管理",
                            "_request_template_management": "申請テンプレート管理",
                            "_inquiry_management": "問合せ管理",
                            "_page_management": "ページ管理"
                        }
                    }
                },
                "messages": {
                    "_create_success": "管理者役割の登録が成功しました。",
                    "_create_failed": "管理者役割の登録に失敗しました。",
                    "_edit_success": "管理者役割の編集が成功しました。",
                    "_edit_failed": "管理者役割の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者役割を削除",
                "_remove_modal_description": "この管理者役割を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "validation": {
            "accepted": "{attribute}を承認してください。",
            "active_url": "{attribute}は、有効なURLではありません。",
            "after": "{attribute}には、{date}以降の日付を指定してください。",
            "after_or_equal": "{attribute}には、{date}以降もしくは同日時を指定してください。",
            "alpha": "{attribute}には、アルファベッドのみ使用できます。",
            "alpha_dash": "{attribute}には、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
            "alpha_num": "{attribute}には、英数字('A-Z','a-z','0-9')が使用できます。",
            "array": "{attribute}には、配列を指定してください。",
            "before": "{attribute}には、{date}以前の日付を指定してください。",
            "before_or_equal": "{attribute}には、{date}以前もしくは同日時を指定してください。",
            "between": {
                "numeric": "{attribute}には、{min}から、{max}までの数字を指定してください。",
                "file": "{attribute}には、{min} KBから{max} KBまでのサイズのファイルを指定してください。",
                "string": "{attribute}は、{min}文字から{max}文字にしてください。",
                "array": "{attribute}の項目は、{min}個から{max}個にしてください。"
            },
            "boolean": "{attribute}には、'true'か'false'を指定してください。",
            "confirmed": "{attribute}と{attribute}確認が一致しません。",
            "date": "{attribute}は、正しい日付ではありません。",
            "date_format": "{attribute}の形式は、'{format}'と合いません。",
            "different": "{attribute}と{other}には、異なるものを指定してください。",
            "digits": "{attribute}は、{digits}桁にしてください。",
            "digits_between": "{attribute}は、{min}桁から{max}桁にしてください。",
            "dimensions": "{attribute}は、正しい縦横比ではありません。",
            "distinct": "{attribute}に重複した値があります。",
            "email": "{attribute}は、有効なメールアドレス形式で指定してください。",
            "exists": "選択された{attribute}は、有効ではありません。",
            "file": "{attribute}はファイルでなければいけません。",
            "filled": "{attribute}は必須です。",
            "image": "{attribute}には、画像を指定してください。",
            "in": "選択された{attribute}は、有効ではありません。",
            "in_array": "{attribute}は、{other}に存在しません。",
            "integer": "{attribute}には、整数を指定してください。",
            "ip": "{attribute}には、有効なIPアドレスを指定してください。",
            "ipv4": "{attribute}はIPv4アドレスを指定してください。",
            "ipv6": "{attribute}はIPv6アドレスを指定してください。",
            "json": "{attribute}には、有効なJSON文字列を指定してください。",
            "max": {
                "numeric": "{attribute}には、{max}以下の数字を指定してください。",
                "file": "{attribute}には、{max} KB以下のファイルを指定してください。",
                "string": "{attribute}は、{max}文字以下にしてください。",
                "array": "{attribute}の項目は、{max}個以下にしてください。"
            },
            "mimes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "mimetypes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "min": {
                "numeric": "{attribute}には、{min}以上の数字を指定してください。",
                "file": "{attribute}には、{min} KB以上のファイルを指定してください。",
                "string": "{attribute}は、{min}文字以上にしてください。",
                "array": "{attribute}の項目は、{max}個以上にしてください。"
            },
            "not_in": "選択された{attribute}は、有効ではありません。",
            "not_regex": "{attribute} は整数で入力してください",
            "numeric": "{attribute}には、数字を指定してください。",
            "present": "{attribute}は、必ず存在しなくてはいけません。",
            "regex": "{attribute}には、有効な正規表現を指定してください。",
            "required": "必ず入力してください。",
            "required_if": "{other}が{value}の場合、{attribute}を指定してください。",
            "required_unless": "{other}が{value}以外の場合、{attribute}を指定してください。",
            "required_with": "{values}が指定されている場合、{attribute}も指定してください。",
            "required_with_all": "{values}が全て指定されている場合、{attribute}も指定してください。",
            "required_without": "{values}が指定されていない場合、{attribute}を指定してください。",
            "required_without_all": "{values}が全て指定されていない場合、{attribute}を指定してください。",
            "same": "{attribute}と{other}が一致しません。",
            "size": {
                "numeric": "{attribute}には、{size}を指定してください。",
                "file": "{attribute}には、{size} KBのファイルを指定してください。",
                "string": "{attribute}は、{size}文字にしてください。",
                "array": "{attribute}の項目は、{size}個にしてください。"
            },
            "string": "{attribute}には、文字を指定してください。",
            "timezone": "{attribute}には、有効なタイムゾーンを指定してください。",
            "unique": "指定の{attribute}は既に使用されています。",
            "uploaded": "{attribute}のアップロードに失敗しました。",
            "url": "{attribute}は、有効なURL形式で指定してください。",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "page": {
            "title_page_list": "Page management",
            "title_page_create": "Page create",
            "title_page_edit": "Page edit",
            "button_create": "Create page",
            "form_filter": {
                "placeholder_input_keyword": "Please enter a keyword",
                "select_all_roles": "All role",
                "select_roles": "Role",
                "input_text_search": "Keyword",
                "button_clear": "Clear",
                "button_search": "Search"
            },
            "table": {
                "name": "Name",
                "email": "Email",
                "role": "Role",
                "note": "Note",
                "last_login": "Last Login",
                "action": "Action",
                "action_edit": "Edit",
                "action_delete": "Remove"
            },
            "form_create": {
                "title": "Account Info",
                "input_name": "Name",
                "input_email": "Email",
                "role": "Role",
                "note": "Note",
                "button_create": "Register",
                "button_edit": "Save",
                "button_remove": "Remove account",
                "alert_create_success": "create admin success",
                "alert_edit_success": "update admin success",
                "alert_error": "Some error occured! Please try again"
            },
            "confirm_remove": {
                "title_remove": "Are you sure？",
                "content": "If you delete your account, all information such as email address and application data will be deleted.",
                "button_cancel": "Cancel",
                "button_success": "Delete account"
            },
            "validator": {
                "name_required": "name is required",
                "name_maxLength": "name cannot exceed 255 characters",
                "email_required": "email is required",
                "email_valid": "incorrect email format",
                "email_maxLength": "email cannot exceed 255 characters"
            }
        },
        "common": [],
        "group": {
            "attr": {
                "_name": "グループ名",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループ一覧",
                "_page_title": "グループ一覧",
                "data_table": {
                    "_staff_count": "ユーザー数",
                    "actions": {
                        "_act_add_user": "グループユーザーを更新する",
                        "_act_edit": "グループ情報を編集する",
                        "_act_remove": "グループを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "グループ削除が成功しました。",
                    "_remove_failed": "グループ削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規グループ登録",
                    "_no_data": "グループが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規グループ登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・グループ情報編集",
                "_page_title_create": "新規グループ登録",
                "_page_title_edit": "グループ情報編集",
                "form": {
                    "_subtitle": "グループ情報",
                    "_name_pl": "グループ名を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "グループ情報の登録が成功しました。",
                    "_create_failed": "グループ情報の登録に失敗しました。",
                    "_edit_success": "グループ情報の編集が成功しました。",
                    "_edit_failed": "グループ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "group_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループユーザー登録",
                "_page_title": "グループユーザー登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "グループユーザーの更新が成功しました。",
                    "_update_failed": "グループユーザーの更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "ユーザーが存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "グループを削除",
                "_remove_modal_description": "このグループを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "pagination": {
            "previous": "&laquo; 前へ",
            "next": "次へ &raquo;"
        },
        "clinic": {
            "attr": {
                "_name": "クリニック名",
                "_prefecture": "都道府県",
                "_zip_code": "郵便番号",
                "_address": "住所",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニック一覧",
                "_page_title": "クリニック一覧",
                "data_table": {
                    "_staff_count": "スタッフ数",
                    "actions": {
                        "_act_add_user": "クリニックスタッフを更新する",
                        "_act_edit": "クリニック情報を編集する",
                        "_act_remove": "クリニックを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "クリニック削除が成功しました。",
                    "_remove_failed": "クリニック削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規クリニック登録",
                    "_no_data": "クリニックが存在しません。",
                    "_no_search_result": "該当するクリニックが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規クリニック登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・クリニック情報編集",
                "_page_title_create": "新規クリニック登録",
                "_page_title_edit": "クリニック情報編集",
                "form": {
                    "_form_title": "クリニック情報",
                    "_name_pl": "クリニック名を入力してください",
                    "_prefecture_df": "都道府県を選択してください",
                    "_zip_code_pl": "郵便番号を入力してください",
                    "_address_pl": "住所を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "クリニック情報の登録が成功しました。",
                    "_create_failed": "クリニック情報の登録に失敗しました。",
                    "_edit_success": "クリニック情報の編集が成功しました。",
                    "_edit_failed": "クリニック情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "clinic_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニックスタッフ登録",
                "_page_title": "クリニックスタッフ登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "スタッフ情報の更新が成功しました。",
                    "_update_failed": "スタッフ情報の更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "クリニック情報を削除",
                "_remove_modal_description": "このクリニックの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "auth": {
            "login": {
                "_og_title": "友伸會ポータル管理画面",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "ログイン",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_password": "パスワード",
                    "_password_pl": "パスワードを入力してください"
                },
                "messages": {
                    "_login_failed": "ログインに失敗しました。"
                },
                "others": {
                    "_btn_login": "ログイン",
                    "_link_forgot_password": "パスワードを忘れた方はこちら"
                }
            },
            "reset_pwd": {
                "_og_title": "友伸會ポータル管理画面｜パスワード再設定",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "パスワード再設定",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください"
                },
                "messages": {
                    "_send_mail_success": "パスワード再設定のメールを送信しました。",
                    "_send_mail_failed": "パスワード再設定のメール送信に失敗しました。"
                },
                "others": {
                    "_btn_login": "パスワードを再設定",
                    "_link_back_to_login": "ログイン画面へ戻す"
                }
            },
            "title_form": "社内ポータルサイト",
            "email_title": "メールアドレス",
            "email_holder": "メールアドレスを入力してください",
            "password_title": "パスワード",
            "password_holder": "パスワードを入力してください",
            "btn_login": "ログイン",
            "title_login": "ログイン",
            "forgot_password": "パスワードを忘れた方はこちら?",
            "title_reset": "パスワードを忘れた方はこちら?",
            "confirm_password": "パスワードを認証する",
            "reset_btn": "リセット"
        }
    },
    "ja": {
        "request": {
            "attr": {
                "_title": "タイトル",
                "_category": "申請項目",
                "_sender": "申請者",
                "_approver": "承認担当者",
                "_status": "ステータス",
                "statuses": {
                    "_open": "承認待ち",
                    "_in_progress": "承認中",
                    "_approved": "承認済み",
                    "_rejected": "却下"
                },
                "_approval_comment": "承認欄",
                "approval_comment": {
                    "_yes": "あり",
                    "_no": "なし"
                },
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請一覧",
                "_page_title": "申請一覧",
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_request_at": "申請日時",
                    "_last_approved_at": "最終承認日時",
                    "actions": {
                        "_act_show_details": "詳細を確認する",
                        "_act_approve": "承認する",
                        "_act_reject": "却下する"
                    }
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。"
                },
                "others": {
                    "_no_data": "申請データが存在しません。",
                    "_no_search_result": "該当する申請データが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請詳細情報",
                "_page_title": "申請詳細情報",
                "basic_info": {
                    "_subtitle": "基本情報",
                    "_approval_comment_pl": "例）精算額など"
                },
                "form": {
                    "_subtitle": "申請情報"
                },
                "reply_form": {
                    "_comment_pl": "コメントを入力してください"
                },
                "messages": {
                    "_approve_success": "申請承認が成功しました。",
                    "_approve_failed": "申請承認に失敗しました。",
                    "_reject_success": "申請ステータスの更新が成功しました。",
                    "_reject_failed": "申請ステータスの更新に失敗しました。",
                    "_reply_success": "返信が成功しました。",
                    "_reply_failed": "返信に失敗しました。"
                },
                "others": {
                    "_btn_approve": "承認する",
                    "_btn_reject": "却下する",
                    "_btn_reply": "返信する"
                }
            },
            "template": {
                "_og_title": "友伸會ポータル管理画面｜申請管理・申請テンプレート一覧",
                "_page_title": "申請テンプレート一覧",
                "data_table": {
                    "_created_at": "作成日時",
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remvoe": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "申請テンプレートの削除が成功しました。",
                    "_remove_failed": "申請テンプレートの削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規テンプレート作成",
                    "_no_data": "申請テンプレートが存在しません。"
                }
            },
            "others": {
                "_modal_no": "キャンセル",
                "_reject_modal_yes": "承認する",
                "_reject_modal_title": "申請を承認",
                "_reject_modal_description": "この申請を承認してもよろしいですか？",
                "_approve_modal_yes": "却下する",
                "_approve_modal_title": "申請を却下",
                "_approve_modal_description": "この申請を却下してもよろしいですか？",
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "申請テンプレートを削除",
                "_remove_modal_description": "このテンプレートを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "app": {
            "name": "友伸會ポータル管理画面",
            "menu": {
                "top": {
                    "_logout": "ログアウト"
                },
                "sidebar": {
                    "admin_management": {
                        "_main": "管理者アカウント管理",
                        "_admin_list": "管理者一覧",
                        "_role_list": "管理者役割一覧"
                    },
                    "staff_management": {
                        "_main": "スタッフ管理",
                        "_clinic_list": "クリニック一覧",
                        "_staff_list": "スタッフ一覧",
                        "_group_list": "グループ一覧"
                    },
                    "notification_management": {
                        "_main": "お知らせ管理"
                    },
                    "request_management": {
                        "_main": "申請管理",
                        "_request_template_list": "申請テンプレート一覧"
                    },
                    "inquiry_management": {
                        "_main": "問合せ管理"
                    },
                    "page_management": {
                        "_main": "ページ管理"
                    }
                }
            }
        },
        "staff": {
            "attr": {
                "_username": "ユーザー名",
                "_mail_address": "メールアドレス",
                "_position": "職業",
                "positions": {
                    "_dr": "DR",
                    "_dh": "DH",
                    "_others": "その他"
                },
                "_clinic": "クリニック",
                "_user_type": "ユーザータイプ",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・スタッフ一覧",
                "_page_title": "スタッフ一覧",
                "search_box": {
                    "_position_df": "すべての職業",
                    "_clinic_df": "すべてのクリニック",
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "スタッフ情報を編集する",
                        "_act_remove": "スタッフ情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "スタッフ情報の削除が成功しました。",
                    "_remove_failed": "スタッフ情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規スタッフ登録",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規スタッフ情報登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・スタッフ情報編集",
                "_page_title_create": "新規スタッフ情報登録",
                "_page_title_edit": "スタッフ情報編集",
                "form": {
                    "_form_title": "スタッフ情報",
                    "_username_pl": "ユーザー名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "職業を選択してください",
                    "_clinic_df": "クリニックを指定してください",
                    "user_type_opt": {
                        "_staff_web": "ウェブユーザー",
                        "_staff_mobile": "スマホアプリユーザー"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "新規スタッフの登録が成功しました。",
                    "_create_failed": "新規スタッフの登録に失敗しました。",
                    "_edit_success": "スタッフ情報の編集が成功しました。",
                    "_edit_failed": "スタッフ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "スタッフ情報を削除",
                "_remove_modal_description": "このスタッフの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "admin": {
            "attr": {
                "_username": "アカウント名",
                "_mail_address": "メールアドレス",
                "_position": "ポジション",
                "_role": "管理者役割",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者一覧",
                "_page_title": "管理者一覧",
                "search_box": {
                    "_role_df": "すべての役割"
                },
                "data_table": {
                    "_registered_at": "登録日時",
                    "_last_login_at": "最終ログイン日時",
                    "actions": {
                        "_act_edit": "管理者情報を編集する",
                        "_act_remove": "管理者情報を削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者情報の削除が成功しました。",
                    "_remove_failed": "管理者情報の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規アカウント登録",
                    "_no_data": "管理者アカウントが存在しません。",
                    "_no_search_result": "該当する管理者情報が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規アカウント登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者情報編集",
                "_page_title_create": "新規アカウント登録",
                "_page_title_edit": "管理者情報編集",
                "form": {
                    "_subtitle": "管理者情報",
                    "_username_pl": "アカウント名を入力してください",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_position_df": "ポジションを選択してください",
                    "position_opt": {
                        "_bod": "理事長",
                        "_hr": "事務局"
                    },
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "管理者アカウントの登録が成功しました。",
                    "_create_failed": "管理者アカウントの登録に失敗しました。",
                    "_edit_success": "管理者情報の編集が成功しました。",
                    "_edit_failed": "管理者情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者情報を削除",
                "_remove_modal_description": "この管理者の情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "notification": {
            "attr": {
                "_title": "タイトル",
                "_target_users": "送信対象者",
                "_confirm_required": "承認必須",
                "_content": "本文",
                "_public_at": "公開日時",
                "_status": "ステータス",
                "status": {
                    "_draft": "下書き",
                    "_private": "非公開",
                    "_public": "公開"
                }
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ一覧",
                "_page_title": "お知らせ一覧",
                "search_box": {
                    "_target_users_df": "すべてのスタッフ",
                    "_public_date": "公開日付",
                    "_status": "公開ステータス",
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_sent_count": "配送総数",
                    "_read_count": "既読数",
                    "_confirmed_count": "確認済人数",
                    "actions": {
                        "_act_public": "お知らせを公開する",
                        "_act_edit": "編集する",
                        "_act_remove": "削除する",
                        "_act_show_details": "詳細を確認んする"
                    }
                },
                "messages": {
                    "_remove_success": "お知らせ削除が成功しました。",
                    "_remove_failed": "お知らせ削除に失敗しました。",
                    "_stt_update_success": "お知らせステータスの更新が成功しました。",
                    "_stt_update_failed": "お知らせステータスの更新に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規作成",
                    "_no_data": "お知らせデータが存在しません。",
                    "_no_search_result": "該当するお知らせデータが存在しません。"
                }
            },
            "info": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・お知らせ作成",
                "_page_title": "お知らせ作成",
                "form": {
                    "_subtitle": "お知らせ情報",
                    "_title_pl": "タイトルを入力してください",
                    "_target_users_des": "※拠点名、職業、及びユーザー名で入力することは可能です。",
                    "target_user_opt": {
                        "_dr": "DR",
                        "_dh": "DH",
                        "_manual": "対象者を指定する",
                        "_manual_pl": "送信対象者のユーザー名を入力してください"
                    }
                },
                "messages": {
                    "_create_success": "お知らせ作成が成功しました。",
                    "_create_failed": "お知らせ作成に失敗しました。",
                    "_draft_save_success": "お知らせの下書き保存が成功しました。",
                    "_draft_save_failed": "お知らせの下書き保存に失敗しました。"
                },
                "others": {
                    "_btn_draft_save": "下書きとして保存",
                    "_btn_create": "公開する",
                    "_btn_remove": "削除する"
                }
            },
            "noti_users": {
                "_og_title": "友伸會ポータル管理画面｜お知らせ管理・送信対象者一覧",
                "_page_title": "送信対象者一覧",
                "attr": {
                    "_status": "ステータス",
                    "status": {
                        "_unread": "未読",
                        "_read": "既読"
                    }
                },
                "search_box": {
                    "_status_df": "すべてのステータス"
                },
                "data_table": {
                    "_confirmed_at": "確認日時"
                },
                "others": {
                    "_unconfirm": "---",
                    "_no_data": "送信対象者が存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "お知らせを削除",
                "_remove_modal_description": "このお知らせを削除してもよろしいですか？一度削除されたお知らせは復旧することはできません。"
            }
        },
        "role": {
            "attr": {
                "_name": "役割",
                "_permission": "権限"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割一覧",
                "_page_title": "管理者役割一覧",
                "data_table": {
                    "actions": {
                        "_act_edit": "編集する",
                        "_act_remove": "削除する"
                    }
                },
                "messages": {
                    "_remove_success": "管理者役割の削除が成功しました。",
                    "_remove_failed": "管理者役割の削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規役割登録",
                    "_no_data": "管理者役割が存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜管理者アカウント管理・新規役割登録",
                "_og_title_edit": "友伸會ポータル管理画面｜管理者アカウント管理・管理者役割編集",
                "_page_title_create": "新規役割登録",
                "_page_title_edit": "管理者役割編集",
                "form": {
                    "_form_title": "管理者役割情報",
                    "_name_pl": "管理者役割の名前を入力してください",
                    "permission_data": {
                        "_feature_list": "機能一覧",
                        "_all_permission": "すべての権限",
                        "_read": "読み取り",
                        "_create": "作成",
                        "_update": "更新",
                        "_remove": "削除",
                        "features": {
                            "_admin_management": "管理者アカウント管理",
                            "_role_management": "管理者役割管理",
                            "_clinic_management": "クリニック管理",
                            "_group_management": "グループ管理",
                            "_staff_management": "スタッフ管理",
                            "_notification_management": "お知らせ管理",
                            "_request_management": "申請管理",
                            "_request_template_management": "申請テンプレート管理",
                            "_inquiry_management": "問合せ管理",
                            "_page_management": "ページ管理"
                        }
                    }
                },
                "messages": {
                    "_create_success": "管理者役割の登録が成功しました。",
                    "_create_failed": "管理者役割の登録に失敗しました。",
                    "_edit_success": "管理者役割の編集が成功しました。",
                    "_edit_failed": "管理者役割の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "管理者役割を削除",
                "_remove_modal_description": "この管理者役割を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "validation": {
            "accepted": "{attribute}を承認してください。",
            "active_url": "{attribute}は、有効なURLではありません。",
            "after": "{attribute}には、{date}以降の日付を指定してください。",
            "after_or_equal": "{attribute}には、{date}以降もしくは同日時を指定してください。",
            "alpha": "{attribute}には、アルファベッドのみ使用できます。",
            "alpha_dash": "{attribute}には、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
            "alpha_num": "{attribute}には、英数字('A-Z','a-z','0-9')が使用できます。",
            "array": "{attribute}には、配列を指定してください。",
            "before": "{attribute}には、{date}以前の日付を指定してください。",
            "before_or_equal": "{attribute}には、{date}以前もしくは同日時を指定してください。",
            "between": {
                "numeric": "{attribute}には、{min}から、{max}までの数字を指定してください。",
                "file": "{attribute}には、{min} KBから{max} KBまでのサイズのファイルを指定してください。",
                "string": "{attribute}は、{min}文字から{max}文字にしてください。",
                "array": "{attribute}の項目は、{min}個から{max}個にしてください。"
            },
            "boolean": "{attribute}には、'true'か'false'を指定してください。",
            "confirmed": "{attribute}と{attribute}確認が一致しません。",
            "date": "{attribute}は、正しい日付ではありません。",
            "date_format": "{attribute}の形式は、'{format}'と合いません。",
            "different": "{attribute}と{other}には、異なるものを指定してください。",
            "digits": "{attribute}は、{digits}桁にしてください。",
            "digits_between": "{attribute}は、{min}桁から{max}桁にしてください。",
            "dimensions": "{attribute}は、正しい縦横比ではありません。",
            "distinct": "{attribute}に重複した値があります。",
            "email": "{attribute}は、有効なメールアドレス形式で指定してください。",
            "exists": "選択された{attribute}は、有効ではありません。",
            "file": "{attribute}はファイルでなければいけません。",
            "filled": "{attribute}は必須です。",
            "image": "{attribute}には、画像を指定してください。",
            "in": "選択された{attribute}は、有効ではありません。",
            "in_array": "{attribute}は、{other}に存在しません。",
            "integer": "{attribute}には、整数を指定してください。",
            "ip": "{attribute}には、有効なIPアドレスを指定してください。",
            "ipv4": "{attribute}はIPv4アドレスを指定してください。",
            "ipv6": "{attribute}はIPv6アドレスを指定してください。",
            "json": "{attribute}には、有効なJSON文字列を指定してください。",
            "max": {
                "numeric": "{attribute}には、{max}以下の数字を指定してください。",
                "file": "{attribute}には、{max} KB以下のファイルを指定してください。",
                "string": "{attribute}は、{max}文字以下にしてください。",
                "array": "{attribute}の項目は、{max}個以下にしてください。"
            },
            "mimes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "mimetypes": "{attribute}には、{values}タイプのファイルを指定してください。",
            "min": {
                "numeric": "{attribute}には、{min}以上の数字を指定してください。",
                "file": "{attribute}には、{min} KB以上のファイルを指定してください。",
                "string": "{attribute}は、{min}文字以上にしてください。",
                "array": "{attribute}の項目は、{max}個以上にしてください。"
            },
            "not_in": "選択された{attribute}は、有効ではありません。",
            "not_regex": "{attribute} は整数で入力してください",
            "numeric": "{attribute}には、数字を指定してください。",
            "present": "{attribute}は、必ず存在しなくてはいけません。",
            "regex": "{attribute}には、有効な正規表現を指定してください。",
            "required": "必ず入力してください。",
            "required_if": "{other}が{value}の場合、{attribute}を指定してください。",
            "required_unless": "{other}が{value}以外の場合、{attribute}を指定してください。",
            "required_with": "{values}が指定されている場合、{attribute}も指定してください。",
            "required_with_all": "{values}が全て指定されている場合、{attribute}も指定してください。",
            "required_without": "{values}が指定されていない場合、{attribute}を指定してください。",
            "required_without_all": "{values}が全て指定されていない場合、{attribute}を指定してください。",
            "same": "{attribute}と{other}が一致しません。",
            "size": {
                "numeric": "{attribute}には、{size}を指定してください。",
                "file": "{attribute}には、{size} KBのファイルを指定してください。",
                "string": "{attribute}は、{size}文字にしてください。",
                "array": "{attribute}の項目は、{size}個にしてください。"
            },
            "string": "{attribute}には、文字を指定してください。",
            "timezone": "{attribute}には、有効なタイムゾーンを指定してください。",
            "unique": "指定の{attribute}は既に使用されています。",
            "uploaded": "{attribute}のアップロードに失敗しました。",
            "url": "{attribute}は、有効なURL形式で指定してください。",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "common": {
            "list": {
                "search_box": {
                    "_keyword": "キーワード",
                    "_keyword_pl": "キーワードを入力してください",
                    "_btn_reset": "条件をクリアする",
                    "_btn_search": "この条件で検索"
                },
                "data_table": {
                    "_id": "#",
                    "_actions": "操作"
                }
            },
            "messsages": {
                "_system_err": "システムエラーが発生しました。しばらく時間をおいてから再度お試しください。"
            }
        },
        "group": {
            "attr": {
                "_name": "グループ名",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループ一覧",
                "_page_title": "グループ一覧",
                "data_table": {
                    "_staff_count": "ユーザー数",
                    "actions": {
                        "_act_add_user": "グループユーザーを更新する",
                        "_act_edit": "グループ情報を編集する",
                        "_act_remove": "グループを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "グループ削除が成功しました。",
                    "_remove_failed": "グループ削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規グループ登録",
                    "_no_data": "グループが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規グループ登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・グループ情報編集",
                "_page_title_create": "新規グループ登録",
                "_page_title_edit": "グループ情報編集",
                "form": {
                    "_subtitle": "グループ情報",
                    "_name_pl": "グループ名を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "グループ情報の登録が成功しました。",
                    "_create_failed": "グループ情報の登録に失敗しました。",
                    "_edit_success": "グループ情報の編集が成功しました。",
                    "_edit_failed": "グループ情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "group_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・グループユーザー登録",
                "_page_title": "グループユーザー登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "グループユーザーの更新が成功しました。",
                    "_update_failed": "グループユーザーの更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "ユーザーが存在しません。",
                    "_no_search_result": "該当するユーザー情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "グループを削除",
                "_remove_modal_description": "このグループを削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "pagination": {
            "previous": "&laquo; 前へ",
            "next": "次へ &raquo;"
        },
        "clinic": {
            "attr": {
                "_name": "クリニック名",
                "_prefecture": "都道府県",
                "_zip_code": "郵便番号",
                "_address": "住所",
                "_memo": "メモ"
            },
            "list": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニック一覧",
                "_page_title": "クリニック一覧",
                "data_table": {
                    "_staff_count": "スタッフ数",
                    "actions": {
                        "_act_add_user": "クリニックスタッフを更新する",
                        "_act_edit": "クリニック情報を編集する",
                        "_act_remove": "クリニックを削除する"
                    }
                },
                "messages": {
                    "_remove_success": "クリニック削除が成功しました。",
                    "_remove_failed": "クリニック削除に失敗しました。"
                },
                "others": {
                    "_btn_create": "新規クリニック登録",
                    "_no_data": "クリニックが存在しません。",
                    "_no_search_result": "該当するクリニックが存在しません。"
                }
            },
            "info": {
                "_og_title_create": "友伸會ポータル管理画面｜スタッフ管理・新規クリニック登録",
                "_og_title_edit": "友伸會ポータル管理画面｜スタッフ管理・クリニック情報編集",
                "_page_title_create": "新規クリニック登録",
                "_page_title_edit": "クリニック情報編集",
                "form": {
                    "_form_title": "クリニック情報",
                    "_name_pl": "クリニック名を入力してください",
                    "_prefecture_df": "都道府県を選択してください",
                    "_zip_code_pl": "郵便番号を入力してください",
                    "_address_pl": "住所を入力してください",
                    "_memo_pl": "メモを入力してください"
                },
                "messages": {
                    "_create_success": "クリニック情報の登録が成功しました。",
                    "_create_failed": "クリニック情報の登録に失敗しました。",
                    "_edit_success": "クリニック情報の編集が成功しました。",
                    "_edit_failed": "クリニック情報の編集に失敗しました。"
                },
                "others": {
                    "_btn_create": "登録する",
                    "_btn_edit": "編集する",
                    "_btn_remove": "削除する"
                }
            },
            "clinic_users": {
                "_og_title": "友伸會ポータル管理画面｜スタッフ管理・クリニックスタッフ登録",
                "_page_title": "クリニックスタッフ登録",
                "data_table": {
                    "_cur_staff_count": "現在のスタッフ数"
                },
                "messages": {
                    "_update_success": "スタッフ情報の更新が成功しました。",
                    "_update_failed": "スタッフ情報の更新に失敗しました。"
                },
                "others": {
                    "_btn_update": "更新する",
                    "_no_data": "スタッフが存在しません。",
                    "_no_search_result": "該当するスタッフ情報が存在しません。"
                }
            },
            "others": {
                "_remove_modal_yes": "はい",
                "_remove_modal_no": "いいえ",
                "_remove_modal_title": "クリニック情報を削除",
                "_remove_modal_description": "このクリニックの情報を削除してもよろしいですか？一度削除された情報は復旧することはできません。"
            }
        },
        "auth": {
            "login": {
                "_og_title": "友伸會ポータル管理画面",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "ログイン",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください",
                    "_password": "パスワード",
                    "_password_pl": "パスワードを入力してください"
                },
                "messages": {
                    "_login_failed": "ログインに失敗しました。"
                },
                "others": {
                    "_btn_login": "ログイン",
                    "_link_forgot_password": "パスワードを忘れた方はこちら"
                }
            },
            "reset_pwd": {
                "_og_title": "友伸會ポータル管理画面｜パスワード再設定",
                "_page_title": "友伸會ポータル管理画面",
                "form": {
                    "_subtitle": "パスワード再設定",
                    "_mail_address": "メールアドレス",
                    "_mail_address_pl": "メールアドレスを入力してください"
                },
                "messages": {
                    "_send_mail_success": "パスワード再設定のメールを送信しました。",
                    "_send_mail_failed": "パスワード再設定のメール送信に失敗しました。"
                },
                "others": {
                    "_btn_login": "パスワードを再設定",
                    "_link_back_to_login": "ログイン画面へ戻す"
                }
            },
            "title_form": "社内ポータルサイト",
            "email_title": "メールアドレス",
            "email_holder": "メールアドレスを入力してください",
            "password_title": "パスワード",
            "password_holder": "パスワードを入力してください",
            "btn_login": "ログイン",
            "title_login": "ログイン",
            "forgot_password": "パスワードを忘れた方はこちら?",
            "title_reset": "パスワードを忘れた方はこちら?",
            "confirm_password": "パスワードを認証する",
            "reset_btn": "リセット"
        }
    }
}
