/*
  +----------------------------------------------------------------------+
  | XlsWriter Extension                                                  |
  +----------------------------------------------------------------------+
  | Copyright (c) 2017-2018 The Viest                                    |
  +----------------------------------------------------------------------+
  | http://www.viest.me                                                  |
  +----------------------------------------------------------------------+
  | Author: viest <dev@service.viest.me>                                 |
  +----------------------------------------------------------------------+
*/

#include "xlswriter.h"
#include "php_streams.h"
#include "ext/standard/file.h"

/* {{{ */
unsigned int xlsx_to_csv(zval *stream_resource, xlsxioreadersheet sheet_t, zval *zv_type_arr_t, unsigned int flag)
{
    zval *_zv_type_arr_t = NULL;
    php_stream *_stream_t;

    ssize_t ret;
    char delimiter = ',';
    char enclosure = '"';
    int escape_char = (unsigned char) '\\';

    ZEND_ASSERT(Z_TYPE_P(stream_resource) == IS_RESOURCE);

    if (((_stream_t) = (php_stream *)zend_fetch_resource2((Z_RES_P(stream_resource)),
            "stream", php_file_le_stream(), php_file_le_pstream())) == NULL) {
        return XLSWRITER_FALSE;
	}

    if (Z_TYPE_P(zv_type_arr_t) == IS_ARRAY) {
        _zv_type_arr_t = zv_type_arr_t;
    }

    zval _zv_tmp_row;
    ZVAL_NULL(&_zv_tmp_row);

    while (sheet_read_row(sheet_t))
    {
        load_sheet_current_row_data(sheet_t, &_zv_tmp_row, _zv_type_arr_t, flag);
        ret = php_fputcsv(_stream_t, &_zv_tmp_row, delimiter, enclosure, escape_char);

        zend_hash_clean(Z_ARRVAL(_zv_tmp_row));

        if (ret < 0) {
            return XLSWRITER_FALSE;
        }
    }

    zval_dtor(&_zv_tmp_row);

    return XLSWRITER_TRUE;
}
/* }}} */